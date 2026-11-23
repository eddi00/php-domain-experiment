<?php

declare(strict_types=1);

namespace App\Freelance\Domain\Events;

use App\Freelance\Domain\Common\IDomainEvent;
use Ramsey\Uuid\UuidInterface;

final class ClientRegistered implements IDomainEvent
{
    public function __construct(
        public readonly UuidInterface $clientId
    ) {}

    public static function getName(): string
    {
        return 'client.registered';
    }
}