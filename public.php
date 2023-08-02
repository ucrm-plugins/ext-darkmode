<?php /** @noinspection PhpMultipleClassDeclarationsInspection */
/** @noinspection PhpUnhandledExceptionInspection */
// This Plugin does nothing when scheduled or manually executed!

require_once __DIR__."/vendor/autoload.php";

use DI\ContainerBuilder;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use SpaethTech\UCRM\SDK\Collections\Collection;
use SpaethTech\UCRM\SDK\Collections\Types\StringCollectionType;
use SpaethTech\UCRM\SDK\Plugin;
use SpaethTech\UCRM\SDK\REST\Endpoints\Country;

$builder = new ContainerBuilder();
$builder->addDefinitions("config.php");
$container = $builder->build();

$plugin = new Plugin($container);
$logger = $plugin->getLogger();
$server = $plugin->getServer();
$client = $server->getClient();

$user = $server->getAuthenticatedUser();

//var_dump($user);



//$collection = new Collection(new StringCollectionType(), "a", "b", "c");
//$test = $collection->first();
//var_dump($test);


//$test = $plugin->request("GET", "/version");
//$test = $plugin->parseResponse($test);
//$test = $plugin->getObjects(Country::class, "/countries");
$test = $plugin->get(Country::class);
//$test = Country::get();
foreach($test as $t)
{
    var_dump((string)$t);
}



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
