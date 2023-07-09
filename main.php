<?php
// This Plugin does nothing when scheduled or manually executed!

require_once __DIR__."/vendor/autoload.php";

use SpaethTech\UCRM\SDK\PluginLog;

$logger = new PluginLog();
//$logger->create("TEST\n");
$logger->append("TEST\n");
