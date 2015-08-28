<?php

use \PodcastSite\Feed\FeedCreatorFactory;

/**
 * The default route
 */
$app->get('/', function () use ($app) {
    $app->render(
        'home.twig', [
            'show' => $app->show,
            'latestEpisode' => $app->episodeLister->getLatestEpisode(),
            'pastEpisodes' => $app->episodeLister->getPastEpisodes(false),
            'upcomingEpisodes' => $app->episodeLister->getUpcomingEpisodes(),
        ]
    );
})->name('home');

/**
 * The about page
 */
$app->get('/about', function () use ($app) {
    $app->render(
        'about.twig', [
            'show' => $app->show
        ]
    );
})->name('about');

/**
 * The contact page
 */
$app->get('/contact', function () use ($app) {
    $app->render(
        'contact.twig', [
            'show' => $app->show
        ]
    );
})->name('contact');

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
                'show' => $app->show,
                'episode' => $episode,
                'route' => sprintf(
                    'http://%s',
                    $_SERVER['HTTP_HOST'] . $app->request()->getResourceUri()
                )
            ]
        );
    }
})->name('episode');

/**
 * Auto-generate the RSS feed, using RSS2 format, which has support for iTunes
 * Currently supports both /rss and /rss.xml whilst a migration from the older (.xml)
 * route is underway.
 */
$app->get('/rss(\.xml)', function() use ($app) {
    $feedCreator = FeedCreatorFactory::factory('itunes');
    $feed = $feedCreator->generateFeed(
        $app->show,
        $app->episodeLister->getPastEpisodes()
    );
    $app->contentType($feed->getContentType());
    print $feed->generate('rss2');
})->name('rss/itunes');
