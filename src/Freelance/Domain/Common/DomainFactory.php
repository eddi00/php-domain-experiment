<?php

namespace App\Freelance\Domain\Common;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class DomainFactory
{
    public static function createUuid(): UuidInterface
    {
        return Uuid::uuid4();
    }
}