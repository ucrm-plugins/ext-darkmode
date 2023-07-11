<?php /** @noinspection PhpUnhandledExceptionInspection */
// This Plugin does nothing when scheduled or manually executed!

require_once __DIR__."/vendor/autoload.php";

use SpaethTech\UCRM\SDK\Data\Collections\OptionCollection;
use SpaethTech\UCRM\SDK\Data\Tables\OptionTable;
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
/** @var OptionCollection $test */
$options = OptionTable::where("option_id >= 4 and option_id <= 6");
//var_dump($options->each(fn($o) => print_r($o)));
//var_dump($options);

//$collection = new Collection([ "a", "b" ]);
//var_dump($collection);

