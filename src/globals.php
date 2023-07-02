<?php
declare(strict_types=1);



if (!defined("PLUGIN_DIR"))
    define("PLUGIN_DIR", realpath(__DIR__));

if (!defined("PLUGIN_LOG"))
    define("PLUGIN_LOG", realpath(PLUGIN_DIR."/data/plugin.log"));

if (!defined("PLUGIN_CONFIG"))
    define("PLUGIN_CONFIG", realpath(PLUGIN_DIR."/data/config.json"));

if (!defined("PLUGIN_MANIFEST"))
    define("PLUGIN_MANIFEST", realpath(PLUGIN_DIR."/manifest.json"));

if (!defined("PLUGIN_JSON"))
    define("PLUGIN_JSON", realpath(PLUGIN_DIR."/ucrm.json"));



$_MANIFEST = [];

//if (($manifest = realpath(PLUGIN_DIR."/manifest.json")) !== false)
if (PLUGIN_MANIFEST !== false)
{
    $_MANIFEST = json_decode(file_get_contents(PLUGIN_MANIFEST), TRUE);

    if(json_last_error() !== JSON_ERROR_NONE)
    {
        $_MANIFEST = [];
    }
    else
    {
        if (!defined("PLUGIN_NAME"))
            define("PLUGIN_NAME", $_MANIFEST["information"]["name"]);

        if (!defined("PLUGIN_VERSION"))
            define("PLUGIN_VERSION", $_MANIFEST["information"]["version"]);
    }

}

$_CONFIG = [];

//if (($config = realpath(PLUGIN_DIR."/data/config.json")) !== false)
if (PLUGIN_CONFIG !== false)
{
    $_CONFIG = json_decode(file_get_contents(PLUGIN_CONFIG), true);

    if(json_last_error() !== JSON_ERROR_NONE)
    {
        $_CONFIG = [];
    }
}

if (array_key_exists("logErrors", $_CONFIG) && $_CONFIG["logErrors"] === true)
{
    // Redirect STDERR to Plugin's own log file
    fclose(STDERR);
    $STDERR = fopen(PLUGIN_DIR."/data/plugin.log", "a");
}

$GLOBALS["_MANIFEST"] = $_MANIFEST;
$GLOBALS["_CONFIG"] = $_CONFIG;
