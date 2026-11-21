<?php

namespace App\Freelance\Application\UseCases\Client;

use App\Freelance\Domain\Client;
use App\Freelance\Domain\Common\DomainFactory;
use App\Freelance\Domain\Email;

class RegisterClientUseCase
{
    public function __construct(
        // private ClientRepository $clientRepository,
    ) {}

    public function execute(string $email): void
    {
        $client = Client::register(DomainFactory::createUuid(), Email::fromString($email));

        // start transaction

        // $this->clientRepository->save($client);

        // commit transaction

        // release domain events
        $domainEvents = $client->pullDomainEvents();

        foreach ($domainEvents as $domainEvent) {
            // publish domain event
        }

        // call application events?
    }
}