<?php

declare(strict_types=1);

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
];
