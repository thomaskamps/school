<?php

error_reporting(E_ALL ^ E_STRICT);

require_once __DIR__.'/../vendor/autoload.php';
include_once __DIR__.'/settings.php';

define('APP_DIR', dirname(__FILE__).'/src');
define('TMP_DIR', dirname(__FILE__).'/../tmp');
define('UPLOAD_DIR', dirname(__FILE__).'/../public_html/upload');
define('CUSTOMCACHE_DIR', dirname(__FILE__).'/../cache/custom.cache');

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\DoctrineServiceProvider; 
use Silex\Provider\FormServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Symfony\Bridge\Doctrine\Form\DoctrineOrmExtension;
use Whoops\Provider\Silex\WhoopsServiceProvider;

use Doctrine\ORM\Tools\Setup; 
use Doctrine\ORM\EntityManager; 

$app = new Application();
$app['debug'] = true;

if($app['debug']) {
    $app->register(new WhoopsServiceProvider);
}

$config_file = __DIR__ . '/database.yml';
$app->register(new DerAlex\Silex\YamlConfigServiceProvider($config_file));

$app->register(new Silex\Provider\DoctrineServiceProvider(), array( 'db.options' => $app['config']['database'] ));


$models = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src/models"), $app["debug"]);
$models->setProxyDir(__DIR__ . "/proxies");
$models->setAutoGenerateProxyClasses(true);

$app["orm.em"] = EntityManager::create($app["db"], $models); 

$app->register(new UrlGeneratorServiceProvider());
$app->register(new FormServiceProvider());

$app['form.extensions'] = $app->share($app->extend('form.extensions', function ($extensions) use ($app) {
    $manager = new forms\ManagerRegistry(
        null, array(), array('orm.em'), null, null, '\Doctrine\ORM\Proxy\Proxy'
    );
    $manager->setContainer($app);
    $extensions[] = new DoctrineOrmExtension($manager);
    $extensions[] = new forms\TypesExtension($app);

    return $extensions;
}));
$app['form.type.extensions'] = $app->share($app->extend('form.type.extensions', function ($extensions) use ($app) {
    $extensions[] = new forms\extensions\FileTypeExtension($app);
    return $extensions;
}));

$app->register(new TranslationServiceProvider(), array(
    'translator.messages' => array(),
));

$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\SecurityServiceProvider());

$app['security.firewalls'] = array(
    'admin' => array(
        'pattern' => '^/admin',
        'http' => true,
        'users' => array(
            // raw password is foo
            'admin' => array('ROLE_ADMIN', '5FZ2Z8QIkA7UTZ4BYkoC+GsReLf569mSKDsfods6LYQ8t+a8EW9oaircfMpmaLbPBh4FOBiiFyLfuZmTSUwzZg=='),
        ),
    ),
);

$app->register(new TwigServiceProvider(), array(
    "twig.path" => __DIR__ . "/src/views/", 
    "twig.form.resources" => array("form_div_layout.html.twig")
));

$app->register(new Silex\Provider\SwiftmailerServiceProvider());

$app->mount("/admin", new AdminController\AdminProvider());
$app->mount("/", new FrontController\FrontProvider());

return $app;

?>