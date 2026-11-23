<?php

declare(strict_types=1);

namespace App\Freelance\Domain\Listeners;

use App\Freelance\Domain\Common\IDomainEventListener;
use App\Freelance\Domain\Common\IDomainEvent;
use App\Freelance\Domain\Events\ClientRegistered;

final class ClientRegisteredSendEmail implements IDomainEventListener
{
    public function __construct()
    {
        // throw new \Exception('Not implemented');
    }

    public static function subscribedTo(): array
    {
        return [ClientRegistered::class];
    }

    public function handler(IDomainEvent $event): void
    {
        $a = 1;
    }
}