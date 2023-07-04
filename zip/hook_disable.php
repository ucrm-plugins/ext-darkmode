<?php /** @noinspection DuplicatedCode */
declare(strict_types=1);

require_once __DIR__."/vendor/autoload.php";

global $_MANIFEST, $_CONFIG;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

$logger = new Logger(PLUGIN_NAME);
$logger->pushHandler(new StreamHandler(PLUGIN_DIR."/data/plugin.log"));

const TWIG_HTML_FILE = "/usr/src/ucrm/app/Resources/views/base.html.twig";
const TWIG_CACHE_DIR = "/usr/src/ucrm/app/cache/prod/twig";

$plugin = PLUGIN_NAME;
$changed = false;

$html = file_get_contents(TWIG_HTML_FILE);
$href = "/crm/_plugins/darkmode/public/css/darkmode.css";
//$link = "<link rel=\"stylesheet\" href=\"$href\\?ver=\d+\.\d+\.\d+\">";
$link = "<link rel=\"stylesheet\" href=\"$href\\?v=[0-9a-f]{40}\">";
$tab  = str_repeat(" ", 8);

switch(preg_match("|$href|", $html))
{
    case 0:
        // Not Found!
        break;
    case 1:
        // Found!
        $html = preg_replace("|^\s*$link\s|ms", "", $html);
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
    exec("rm -rf ".TWIG_CACHE_DIR);
    $logger->info("Cleared twig template cache");
}

