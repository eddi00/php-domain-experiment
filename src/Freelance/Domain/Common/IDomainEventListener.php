<?php

declare(strict_types=1);

namespace App\Freelance\Domain\Common;

interface IDomainEventListener {
    public function handler(IDomainEvent $event): void;

    /** @return list<class-string<IDomainEvent>> */
    public static function subscribedTo(): array;
}