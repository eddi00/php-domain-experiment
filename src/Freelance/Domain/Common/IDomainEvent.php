<?php

declare(strict_types=1);

namespace App\Freelance\Domain\Common;

interface IDomainEvent
{
    public static function getName(): string;
}