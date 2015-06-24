<?php

require_once '../vendor/autoload.php';

date_default_timezone_set('Europe/Berlin');

use Slim\Slim;
use PodcastSite\Episodes\EpisodeLister;
use Mni\FrontYAML\Parser;

// Initialise a Slim app
$app = new Slim(array(
    'debug' => true,
    'mode' => 'development',
    'view' => new \Slim\Views\Twig(),
    'templates.path' => dirname(__FILE__) . '/../storage/templates'
));

$app->episodeLister = EpisodeLister::factory([
    'type' => 'filesystem',
    'path' => dirname(__FILE__) . '/../storage/posts',
    'parser' => new Parser()
]);

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

/**
 * Get a listing of all episodes
 */
$app->get('/episodes', function () use ($app) {
    $app->render(
        'episodes.twig', [
            /** @var \PodcastSite\Episodes\EpisodeListerInterface $app->episodeLister */
            'episodes' => $app->episodeLister->getEpisodeList()
        ]
    );
});

/**
 * Get an episode
 */
$app->get('/episode/:episodeSlug', function ($episodeSlug) use ($app) {
    $episode = $app->episodeLister->getEpisode($episodeSlug);
    if (is_null($episode)) {
        $app->notFound();
    } else {
        $app->render(
            'episode.twig', [
                'episode' => $episode
            ]
        );
    }
});

$app->notFound(function () use ($app) {
    $app->render('404.twig');
});

$app->error(function (\Exception $e) use ($app) {
    $app->render('500.twig');
});

$app->run();
