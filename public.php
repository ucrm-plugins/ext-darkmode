<?php
// This Plugin does nothing when scheduled or manually executed!

require_once __DIR__."/vendor/autoload.php";

use SpaethTech\UCRM\SDK\PluginConfig;
use SpaethTech\UCRM\SDK\PluginLogger;
use SpaethTech\UCRM\SDK\PluginManifest;
use SpaethTech\UCRM\SDK\UcrmParameters;
use SpaethTech\UCRM\SDK\Plugin;

$plugin = new Plugin();

//var_dump($plugin->manifest->get("information.name"));
//var_dump($plugin->manifest->get);

var_dump(PLUGIN_DIR);

var_dump($plugin->getDataPath());

var_dump(UcrmParameters::get("secret"));
var_dump(PluginManifest::get("information.name"));
//Logger::debugPlugin(Manifest::get("information"));
var_dump(PluginManifest::get("information"));
var_dump(PluginConfig::get());

var_dump($plugin->getCryptoKey()->saveToAsciiSafeString());
