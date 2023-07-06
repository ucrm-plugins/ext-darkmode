<?php
// This Plugin does nothing when scheduled or manually executed!

require_once __DIR__."/vendor/autoload.php";

use SpaethTech\UCRM\SDK\PluginLogger;

$logger = new PluginLogger();
//$logger->create("TEST\n");
$logger->append("TEST\n");
