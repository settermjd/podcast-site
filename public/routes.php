<?php

/**
 * List all calls on the account
 */
$app->get('/', function () use ($app) {
    $app->render(
        'home.twig', [
            /** @var \PodcastSite\Episodes\EpisodeListerInterface $app->episodeLister */
            'episodes' => $app->episodeLister->getEpisodeList()
        ]
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

$app->get('/rss', function() use ($app) {
    /**
     * Create the parent feed
     */
    $feed = new Zend\Feed\Writer\Feed;
    $feed->setTitle('Paddy\'s Blog');
    $feed->setLink('http://www.freethegeek.fm');
    $feed->setFeedLink('http://www.freethegeek.com/feed/rss', 'rss');
    $feed->addAuthor(array(
        'name'  => 'Matthew Setter',
        'email' => 'matthew@freethegeek.fm',
        'uri'   => 'http://www.freethegeek.fm',
    ));
    $feed->setDateModified(time());
    $feed->setDescription("Here's a description");

    /**
     * Add one or more entries. Note that entries must
     * be manually added once created.
     */
    $entry = $feed->createEntry();
    $entry->setTitle('All Your Base Are Belong To Us');
    $entry->setLink('http://www.example.com/all-your-base-are-belong-to-us');
    $entry->addAuthor(array(
        'name'  => 'Paddy',
        'email' => 'paddy@example.com',
        'uri'   => 'http://www.example.com',
    ));
    $entry->setDateModified(time());
    $entry->setDateCreated(time());
    $entry->setDescription('Exposing the difficultly of porting games to English.');
    $entry->setContent(
        'I am not writing the article. The example is long enough as is ;).'
    );
    $feed->addEntry($entry);

    /**
     * Render the resulting feed to Atom 1.0 and assign to $out.
     * You can substitute "atom" with "rss" to generate an RSS 2.0 feed.
     */
    $app->response()->header('Content-Type', 'application/rss+xml');
    $app->render('rss-feed.twig');

    $response = $app->response();
    $response['Content-Type'] = 'application/rss+xml';
    $response->body($feed->export('rss'));
});
