<?php
/**
 * @noinspection DuplicatedCode
 * @noinspection PhpIncludeInspection
 * @noinspection PhpMultipleClassDeclarationsInspection
 * @noinspection PhpUnhandledExceptionInspection
 */
declare(strict_types=1);
require_once __DIR__."/vendor/autoload.php";

if(!defined("PLUGIN_DIR"))
    define("PLUGIN_DIR", realpath(__DIR__));

use DI\ContainerBuilder;
use SpaethTech\UCRM\SDK\Plugin;

$builder = new ContainerBuilder();
$builder->addDefinitions("config.php");
$container = $builder->build();

$plugin = new Plugin($container);
$logger = $plugin->getLogger();

$logger->info("This plugin has only static public files!");
