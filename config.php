<?php /** @noinspection PhpUnused, PhpMultipleClassDeclarationsInspection */
declare(strict_types=1);

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

return [
    "plugin.root" => __DIR__,

    LoggerInterface::class => DI\create(Logger::class)
        ->constructor("plugin")
        ->method("pushHandler", new StreamHandler("data/plugin.log")),


    // ...
];
