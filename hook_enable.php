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
use SpaethTech\UCRM\SDK\Support\UrlWrapper;

$builder = new ContainerBuilder();
$builder->addDefinitions("config.php");
$container = $builder->build();

$plugin = new Plugin($container);
$logger = $plugin->getLogger();
$server = $plugin->getServer();
$styles = (new UrlWrapper("/crm/_plugins/darkmode/public/css/darkmode.css"))->withVersion();
$change = false;

switch(preg_match("|$styles|", $html = $server->getTwigView("base.html.twig")))
{
    case 0:
        // Not Found!
        $search = preg_quote("{% block stylesheets %}");
        $replace = str_repeat(" ", 8)."<link rel=\"stylesheet\" href=\"$styles\">";
        $html = preg_replace("|^(\s*$search)|m", "$replace\n\$1", $html);
        $change = true;
        $logger->info("Dark Mode enabled");
        break;
    case 1:
        // Found!
        $logger->debug("Stylesheet darkmode.css is already included, did something go wrong?");
        break;
    case false:
        // Error!
        $logger->error("WTF?");
        break;
}

if($change)
{
    $server->putTwigView("base.html.twig", $html);
    $server->clearTwigCache();
    Header('Location: '.$_SERVER['PHP_SELF']); // Only needed on first Enable after install?
    $logger->info("Cleared twig template cache");
}

$logger->debug("Enable Hook!");
