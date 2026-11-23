<?php

declare(strict_types=1);

namespace App\Freelance\Infrastructure\Event;

use App\Freelance\Domain\Common\IDomainEvent;

interface IDomainEventDispatcher
{
    public function dispatch(IDomainEvent $event): void;
}