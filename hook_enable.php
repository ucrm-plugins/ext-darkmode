<?php /** @noinspection DuplicatedCode */
declare(strict_types=1);

use DI\ContainerBuilder;
use SpaethTech\UCRM\SDK\Plugin;
use SpaethTech\UCRM\SDK\Server;

require_once __DIR__."/vendor/autoload.php";

$builder = new ContainerBuilder();
$builder->addDefinitions("config.php");
$container = $builder->build();

$plugin = new Plugin($container);
$logger = $plugin->getLogger();

const TWIG_HTML_FILE = "/usr/src/ucrm/app/Resources/views/base.html.twig";
//const TWIG_CACHE_DIR = "/usr/src/ucrm/app/cache/prod/twig";

// https://uisp.dev/crm/assets/images/favicon/favicon-152.png?v=697178f83c86868c9dc5c48123d4c34de84b32b9

$version = sha1(microtime(true).mt_rand(10000,90000));

$changed = false;
$html = file_get_contents(TWIG_HTML_FILE);
//$href = "/crm/_plugins/darkmode/public/css/darkmode.css?ver=".PLUGIN_VERSION;
$href = "/crm/_plugins/darkmode/public/css/darkmode.css?v=$version";
$link = "<link rel=\"stylesheet\" href=\"$href\">";
$tab = str_repeat(" ", 8);

switch(preg_match("|$href|", $html))
{
    case 0:
        // Not Found!
        $spot = preg_quote("{% block stylesheets %}");
        $html = preg_replace("|^(\s*$spot)|m", "$tab$link\n\$1", $html);
        $changed = true;
        $logger->info("Dark Mode enabled");
        break;
    case 1:
        // Found!
        $logger->info("Stylesheet darkmode.css is already included, did something go wrong?");
        break;
    case false:
        // Error!
        break;
}

if($changed)
{
    file_put_contents(TWIG_HTML_FILE, $html);
    //exec("rm -rf ".TWIG_CACHE_DIR);
    Server::clearTwigCache();
    $logger->info("Cleared twig template cache");
}

