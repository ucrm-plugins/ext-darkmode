<?php
// This Plugin does nothing when scheduled or manually executed!

require_once __DIR__."/vendor/autoload.php";

use SpaethTech\UCRM\SDK\Data\Tables\AppKeyTable;
use SpaethTech\UCRM\SDK\Data\Tables\OptionTable;
use SpaethTech\UCRM\SDK\Data\Tables\PluginTable;
use SpaethTech\UCRM\SDK\PluginConfig;
use SpaethTech\UCRM\SDK\PluginManifest;
use SpaethTech\UCRM\SDK\PluginDatabase;
use SpaethTech\UCRM\SDK\PluginUcrm;
use SpaethTech\UCRM\SDK\UcrmDatabase;
use SpaethTech\UCRM\SDK\UcrmVersion;
use SpaethTech\UCRM\SDK\UcrmParameters;
use SpaethTech\UCRM\SDK\Plugin;

$plugin = new Plugin();
//
//var_dump(PLUGIN_DIR);
//var_dump($plugin->getDataPath());
//
//var_dump(UcrmParameters::get("secret"));
//var_dump(PluginManifest::get("information.name"));
////Logger::debugPlugin(Manifest::get("information"));
//var_dump(PluginManifest::get("information"));
//var_dump(PluginConfig::get());
//
////var_dump($plugin->getCryptoKey()->saveToAsciiSafeString());
//var_dump($plugin->getMode());
//
//var_dump(PluginUcrm::get("pluginAppKey"));
//var_dump(UcrmVersion::get("version"));
//
//$db = new PluginDatabase();
//$pdo = $db->connect();
//$permissions = $db->permissions();
//var_dump($permissions);
//
//$pdo = UcrmDatabase::connect();

//$test = UcrmDatabase::query("SELECT * FROM app_key WHERE name = 'plugin_darkmode'");
//$test = UcrmDatabase::select("app_key", [ "name", "type", "plugin_id" ]);
//$test = AppKeyTable::all();
//$test = OptionTable::all();

//$test = OptionTable::where("option_id = 4");
$test = OptionTable::where("option_id = 4");


//$test = PluginTable::all();
var_dump($test);
