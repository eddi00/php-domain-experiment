<?php

declare(strict_types=1);

namespace App\Freelance\Application\UseCases\Client;

use App\Freelance\Domain\Client;
use App\Freelance\Domain\Common\DomainFactory;
use App\Freelance\Domain\Common\IDomainEvent;
use App\Freelance\Domain\Email;
use App\Freelance\Infrastructure\Event\IDomainEventDispatcher;

class RegisterClientUseCase
{
    public function __construct(
        // private ClientRepository $clientRepository,
        private IDomainEventDispatcher $eventDispatcher
    ) {}

    public function execute(string $email): void
    {
        $client = Client::register(DomainFactory::createUuid(), Email::fromString($email));

        // start transaction

        // $this->clientRepository->save($client);

        // commit transaction

        // release domain events
        $domainEvents = $client->pullDomainEvents();

        // publish domain event
        /** @var IDomainEvent $domainEvent */
        foreach ($domainEvents as $domainEvent) {
            $this->eventDispatcher->dispatch($domainEvent);
        }

        // call application events?
    }
}