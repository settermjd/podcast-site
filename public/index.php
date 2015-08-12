<?php

require_once '../c3.php';
require_once '../vendor/autoload.php';

date_default_timezone_set('Europe/Berlin');

use Slim\Slim;
use PodcastSite\Episodes\EpisodeLister;
use PodcastSite\Extensions\Twig\GravatarExtension;
use Mni\FrontYAML\Parser;
use Zend\Cache\StorageFactory;
use Zend\Config\Config;
use Aptoma\Twig\Extension\MarkdownExtension;
use Aptoma\Twig\Extension\MarkdownEngine;


// Initialise a Slim app
$app = new Slim(array(
    'debug' => true,
    'mode' => 'development',
    'view' => new \Slim\Views\Twig(),
    'templates.path' => dirname(__FILE__) . '/../storage/templates'
));

// Add Middleware
$app->add(new \PodcastSite\Middleware\Analytics\GoogleAnalytics());

// Add Cache support
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
$app->cache = $cache;

$config = new Config(
    require_once(dirname(__FILE__) . '/../config/application.php')
);
$app->config = $config;

// Add Episode Lister support
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

$engine = new MarkdownEngine\MichelfMarkdownEngine();
$view->parserExtensions = array(
    new MarkdownExtension($engine),
    new GravatarExtension(),
);

// Add in the routes for the application
require_once('routes.php');

// Add support for 404's and 500's.
$app->notFound(function () use ($app) {
    $app->render('404.twig');
});

$app->error(function (\Exception $e) use ($app) {
    $app->render('500.twig');
});

// Launch the application
$app->run();
