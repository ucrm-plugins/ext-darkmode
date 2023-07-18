<?php /** @noinspection PhpUnhandledExceptionInspection */
// This Plugin does nothing when scheduled or manually executed!

require_once __DIR__."/vendor/autoload.php";

use DI\ContainerBuilder;
use SpaethTech\UCRM\SDK\Plugin;
use SpaethTech\UCRM\SDK\Server;

$builder = new ContainerBuilder();
$builder->addDefinitions("config.php");
$container = $builder->build();

$plugin = new Plugin($container);
$logger = $plugin->getLogger();
$server = $plugin->getServer();


$manifest = $plugin->getManifest();
$test = $manifest->get("information.name");
var_dump($test);

$config = $plugin->getConfig();
$test = $config->get("logErrors");
//var_dump($test);
//$config->set("logErrors", true);
//$config->save();

$ucrm = $plugin->getUcrm();
$test = $ucrm->get("ucrmPublicUrl");
//var_dump($test);

$parameters = $server->getParameters();
$test = $parameters->get();
var_dump($test);

$version = $server->getVersion();
$test = $version->get();
var_dump($test);

$plugins = $server->getPlugins();
foreach($plugins as $p)
    var_dump($p->getRootPath());
