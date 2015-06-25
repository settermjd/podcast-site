<?php

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
