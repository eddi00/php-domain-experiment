<?php

declare(strict_types=1);

namespace App\Freelance\Domain;

use App\Freelance\Domain\Common\DomainEventsTrait;
use App\Freelance\Domain\Events\ClientRegistered;
use Ramsey\Uuid\UuidInterface;

final class Client
{
    use DomainEventsTrait;

    private function __construct(
        public readonly UuidInterface $id,
        private Email $email,
    ) {}

    public static function register(UuidInterface $id, Email $email): self
    {
        $client = new self($id, $email);

        $client->recordDomainEvent(new ClientRegistered($client->$id));

        return $client;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->toString(),
            'email' => $this->email->toString(),
        ];
    }
}