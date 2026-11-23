<?php

declare(strict_types=1);

use App\Freelance\Application\UseCases\Client\RegisterClientUseCase;
use App\Freelance\Infrastructure\Event\DomainEventDispatcher;
use App\Freelance\Infrastructure\Event\IDomainEventDispatcher;
use Psr\Container\ContainerInterface;

use function DI\autowire;
use function DI\get;

return [
    /*==========================================
        Database
     ==========================================*/
    // Connection::class => function () {
    //     $config = require __DIR__ . '/../config/database.php';
    //     return DriverManager::getConnection($config);
    // },

    // UnitOfWorkInterface::class => autowire(UnitOfWork::class),
    IDomainEventDispatcher::class => function (ContainerInterface $c) {
        return new DomainEventDispatcher($c);
    },

    RegisterClientUseCase::class => autowire(RegisterClientUseCase::class)
];
