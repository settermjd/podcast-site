<?php

require_once '../vendor/autoload.php';

date_default_timezone_set('Europe/Berlin');

use Slim\Slim;

// Initialise a Slim app
$app = new Slim(array(
    'debug' => true,
    'mode' => 'development',
    'view' => new \Slim\Views\Twig(),
    'templates.path' => dirname(__FILE__) . '/../storage/templates'
));

// Setup the app views
$view = $app->view();

$view->parserOptions = array(
    'debug' => true,
    'cache' => dirname(__FILE__) . '/../storage/cache'
);

/**
 * List all calls on the account
 */
$app->get('/', function () use ($app) {
    $app->render(
        'home.twig', []
    );
});

$app->notFound(function () use ($app) {
    $app->render('404.twig');
});

$app->error(function (\Exception $e) use ($app) {
    $app->render('500.twig');
});

$app->run();
