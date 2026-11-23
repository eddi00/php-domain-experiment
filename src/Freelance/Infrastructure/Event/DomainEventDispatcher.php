<?php

declare(strict_types=1);

namespace App\Freelance\Infrastructure\Event;

use App\Freelance\Domain\Common\IDomainEvent;
use App\Freelance\Domain\Common\IDomainEventListener;
use FilesystemIterator;
use Psr\Container\ContainerInterface;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionClass;
use RuntimeException;
use UnexpectedValueException;

final class DomainEventDispatcher implements IDomainEventDispatcher
{
    private const LISTENER_NAMESPACE = 'App\\Freelance\\Domain\\Listeners\\';

    /** @var array<string, list<class-string<IDomainEventListener>>> */
    private array $listeners = [];

    public function __construct(private ContainerInterface $container)
    {
        $listenerDirectory = dirname(__DIR__, 2) . '/Domain/Listeners';
        if (!is_dir($listenerDirectory)) {
            throw new RuntimeException(sprintf('Listener directory "%s" does not exist.', $listenerDirectory));
        }

        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($listenerDirectory, FilesystemIterator::SKIP_DOTS)
        );

        foreach ($files as $file) {
            if (!$file->isFile() || $file->getExtension() !== 'php') {
                continue;
            }

            $relativePath = substr($file->getPathname(), strlen($listenerDirectory) + 1);
            $className = self::LISTENER_NAMESPACE . str_replace(
                DIRECTORY_SEPARATOR,
                '\\',
                substr($relativePath, 0, -4)
            );

            if (!class_exists($className)) {
                throw new RuntimeException(sprintf('Listener file "%s" did not define class "%s".', $file, $className));
            }

            $reflection = new ReflectionClass($className);
            if (!$reflection->implementsInterface(IDomainEventListener::class) || !$reflection->isInstantiable()) {
                continue;
            }

            foreach ($className::subscribedTo() as $eventClass) {
                if (!is_string($eventClass) || !is_subclass_of($eventClass, IDomainEvent::class)) {
                    throw new UnexpectedValueException(sprintf(
                        'Listener "%s" subscribed to an invalid domain event.',
                        $className
                    ));
                }

                $this->listeners[$eventClass::getName()][] = $className;
            }
        }
    }

    public function dispatch(IDomainEvent $event): void
    {
        foreach ($this->listeners[$event::getName()] ?? [] as $listenerClass) {
            $listener = $this->container->get($listenerClass);
            if (!$listener instanceof IDomainEventListener) {
                throw new UnexpectedValueException(sprintf(
                    'Container entry "%s" must implement %s.',
                    $listenerClass,
                    IDomainEventListener::class
                ));
            }

            $listener->handler($event);
        }
    }
}