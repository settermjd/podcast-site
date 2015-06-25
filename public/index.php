<?php

require_once '../vendor/autoload.php';

date_default_timezone_set('Europe/Berlin');

use Slim\Slim;
use PodcastSite\Episodes\EpisodeLister;
use Mni\FrontYAML\Parser;
use Zend\Cache\StorageFactory;
use Zend\Config\Config;

// Create a cache object, via factory:

// Add Middleware
$app->add(new \PodcastSite\Middleware\Analytics\GoogleAnalytics());
$cache = StorageFactory::factory(array(
    'adapter' => array(
        'name'    => 'filesystem',
        'options' => array(
            'ttl' => 3600,
            'cacheDir' => dirname(__FILE__) . '/../storage/cache/app-cache'
        ),
    ),
    'plugins' => array(
        'exception_handler' => array('throw_exceptions' => false),
        'serializer'
    ),
));


// Initialise a Slim app
$app = new Slim(array(
    'debug' => true,
    'mode' => 'development',
    'view' => new \Slim\Views\Twig(),
    'templates.path' => dirname(__FILE__) . '/../storage/templates'
));

$app->cache = $cache;

$config = new Config(
    require_once(dirname(__FILE__) . '/../config/application.php')
);
$app->config = $config;
$app->episodeLister = EpisodeLister::factory([
    'type' => 'filesystem',
    'path' => dirname(__FILE__) . '/../storage/posts',
    'parser' => new Parser(),
    'cache' => $app->cache
]);

// Setup the app views
$view = $app->view();

$view->parserOptions = array(
    'debug' => true,
    'cache' => dirname(__FILE__) . '/../storage/cache/template-cache'
);

// Add in the routes for the application
require_once('routes.php');

$app->notFound(function () use ($app) {
    $app->render('404.twig');
});

$app->error(function (\Exception $e) use ($app) {
    $app->render('500.twig');
});

$app->run();
