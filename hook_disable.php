<?php
declare(strict_types=1);

use SpaethTech\UCRM\SDK\Plugin;
use SpaethTech\UCRM\SDK\PluginLog;
use SpaethTech\UCRM\SDK\Server;

require_once __DIR__."/vendor/autoload.php";

const TWIG_HTML_FILE = "/usr/src/ucrm/app/Resources/views/base.html.twig";
const TWIG_CACHE_DIR = "/usr/src/ucrm/app/cache/prod/twig";

$plugin = new Plugin(__DIR__);



$changed = false;

$html = file_get_contents(TWIG_HTML_FILE);
$href = "/crm/_plugins/darkmode/public/css/darkmode.css";
//$link = "<link rel=\"stylesheet\" href=\"$href\\?ver=\d+\.\d+\.\d+\">";
$link = "<link rel=\"stylesheet\" href=\"$href\\?v=[0-9a-f]{40}\">";
PluginLog::debug($link);
$tab  = str_repeat(" ", 8);

$test = preg_match("|$href|", $html);
PluginLog::debug((string)$test);
switch($test)
{
    case 0:
        // Not Found!
        break;
    case 1:
        // Found!
        /** @noinspection HtmlUnknownTarget */
        $line = '<link rel="stylesheet" href="/crm/_plugins/darkmode/public/css/darkmode\.css\?v=[0-9a-f]{40}">';
        $html = preg_replace("|^\s*$line\s|ms", "", $html);
        $changed = true;
        PluginLog::info("Dark Mode disabled");
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
    PluginLog::info("Cleared twig template cache");
}


