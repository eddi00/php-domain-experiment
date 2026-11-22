<?php

declare(strict_types=1);

namespace App\Freelance\Domain\Events;

use App\Freelance\Domain\Common\IDomainEvent;
use Ramsey\Uuid\UuidInterface;

class ClientRegistered implements IDomainEvent
{
    public function __construct(
        public readonly UuidInterface $clientId
    ) {}
}