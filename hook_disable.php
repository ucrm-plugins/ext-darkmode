<?php
/** @noinspection PhpUnhandledExceptionInspection */
declare(strict_types=1);

use DI\ContainerBuilder;
use SpaethTech\UCRM\SDK\Plugin;
use SpaethTech\UCRM\SDK\Support\UrlWrapper;

require_once __DIR__."/vendor/autoload.php";

$builder = new ContainerBuilder();
$builder->addDefinitions("config.php");
$container = $builder->build();

$plugin = new Plugin($container);
$logger = $plugin->getLogger();
$server = $plugin->getServer();

const TWIG_HTML_FILE = "/usr/src/ucrm/app/Resources/views/base.html.twig";
const TWIG_CACHE_DIR = "/usr/src/ucrm/app/cache/prod/twig";

$url = (new UrlWrapper("/crm/_plugins/darkmode/public/css/darkmode.css"))->withVersion();

$changed = false;

$html = file_get_contents(TWIG_HTML_FILE);
$link = "<link rel=\"stylesheet\" href=\"{$url->getPath()}\\?v=[0-9a-f]{40}\">";
//$tab  = str_repeat(" ", 8);

switch(preg_match("|{$url->getPath()}|", $html))
{
    case 0:
        // Not Found!
        break;
    case 1:
        // Found!
        //$html = preg_replace('|^\s*<link rel="stylesheet" href="'.$url->pregEscaped().'">\s|ms', "", $html);
        $html = preg_replace("|^\s*<link rel=\"stylesheet\" href=\"{$url->pregEscaped()}\">\s|ms", "", $html);


        $changed = true;
        $logger->info("Dark Mode disabled");
        break;
    case false:
        // Error!
        break;
}

if($changed)
{
    file_put_contents(TWIG_HTML_FILE, $html);
    //exec("rm -rf ".TWIG_CACHE_DIR);
    $server->clearTwigCache();
    $logger->info("Cleared twig template cache");
}

$logger->debug("Disable Hook!");
