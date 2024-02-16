<?php /** @noinspection PhpMultipleClassDeclarationsInspection */
/** @noinspection PhpUnhandledExceptionInspection */
// This Plugin does nothing when scheduled or manually executed!

use DI\ContainerBuilder;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use SpaethTech\UCRM\SDK\Plugin;
use SpaethTech\UCRM\SDK\REST\EndpointBuilder;
use SpaethTech\UCRM\SDK\REST\Endpoints\Client;
use SpaethTech\UCRM\SDK\REST\Endpoints\ClientTag;
use SpaethTech\UCRM\SDK\REST\Endpoints\Fee;
use SpaethTech\UCRM\SDK\REST\Endpoints\State;
use SpaethTech\UCRM\SDK\REST\Endpoints\User;

require_once __DIR__."/vendor/autoload.php";

if(!defined("PLUGIN_DIR"))
    define("PLUGIN_DIR", realpath(__DIR__));

$builder = new ContainerBuilder();
$builder->addDefinitions("config.php");
$container = $builder->build();

$plugin = new Plugin($container);
$logger = $plugin->getLogger();
$server = $plugin->getServer();
$client = $server->createRestClient();

$user = $server->getAuthenticatedUser();
//var_dump($user);

//EndpointBuilder::build("State");

//$test = $plugin->getAll(State::class);
//echo "<pre>$test</pre>";


$test = Client::getCollection();
echo "<pre>$test</pre>";
//$test = User::delete([])


exit;

//$test = $plugin->getAll(Client::class);

//$test = Client::getById(1);
//$test = ClientTag::getById(3);
//$test = ClientTag::get();
$newTag = ClientTag::create("Owners");
$test = $newTag->post();
echo "POST: <pre>$test</pre>";

$test->setName("Owner's Spouse");
$test = $test->patch();
echo "PATCH: <pre>$test</pre>";
//
//$test->delete();
//$test = ClientTag::get();
//echo "AFTER DELETE: <pre>$test</pre>";

//$test = $plugin->delete(ClientTag::class, [ "id" => 18 ]);
//echo "<pre>".($test ? "T" : "F")."</pre>";


//$test = $plugin->getAll(ClientTag::class, [ "clientId" => 1 ]);
//$test = $test->first()->getId();
//$test = (string)$test;

/*
$tag = ClientTag::create("VIP");
$new = $plugin->postOne($tag);
echo "<pre>$new</pre>";
*/


//echo "<pre>$test</pre>";




//foreach($test as $t)
//{
//    var_dump((string)$t);
//}



//var_dump($test);


//$manifest = $plugin->getManifest();
//$test = $manifest->get("information.name");
//var_dump($test);

//$config = $plugin->getConfig();
//$test = $config->get("logErrors");
//var_dump($test);
//$config->set("logErrors", true);
//$config->save();

//$ucrm = $plugin->getUcrm();
//$test = $ucrm->get("ucrmPublicUrl");
//var_dump($test);

//$version = $server->createVersion("test.html?test=true");
//$version = $server->createVersion("test.html?test=true#welcome");
//$url = (new UrlWrapper("/crm/_plugins/darkmode/public/css/darkmode.css"))->withVersion();
//var_dump($url->getPath());

//$parameters = $server->getParameters();
//$test = $parameters->get();
//var_dump($test);

//$version = $server->getVersion();
//$test = $version->get();
//var_dump($test);

//$plugins = $server->getPlugins();
//foreach($plugins as $p)
//    var_dump($p->getRootPath());

$app = $plugin->createSlimApp();



$app->get("/", function (Request $request, Response $response)
{
    //$response->getBody()->write("Darkmode Plugin");
    return $response;
});

$app->run();
