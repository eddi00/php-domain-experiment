<?php

declare(strict_types=1);

namespace App\Freelance\Domain\Common;

trait DomainEventsTrait
{
    /** @var IDomainEvent[] */
    private array $domainEvents = [];

    public function recordDomainEvent(IDomainEvent $event): void
    {
        $this->domainEvents[] = $event;
    }

    public function pullDomainEvents(): array
    {
        $events = $this->domainEvents;
        $this->domainEvents = [];

        return $events;
    }
}