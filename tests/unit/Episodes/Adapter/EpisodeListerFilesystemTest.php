<?php

use PodcastSite\Episodes\Adapter\EpisodeListerFilesystem;
use PodcastSite\Episodes\EpisodeLister;
use Mni\FrontYAML\Parser;

/**
 * Class EpisodeListerFilesystem
 *
 * @coversDefaultClass \PodcastSite\Episodes\Adapter\EpisodeListerFilesystem
 */
class EpisodeListerFilesystemTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
    }

    protected function tearDown()
    {
    }

    // tests
    public function testMe()
    {
    }

    /**
     * @covers ::buildEpisode
     */
    public function testAdapterCanProperlyBuildEpisodeObject()
    {
        $filePath = dirname(__FILE__) . '/../../../_data/posts';
        $episodeLister = EpisodeLister::factory([
            'type' => 'filesystem',
            'path' => $filePath,
            'parser' => new Parser()
        ]);

        $content = <<<EOF
### Synopsis

In this, the first episode, Matt talks about what lead to the podcast getting started who motivated him and inspired him to get started. After that, he discusses a fantastic book that all freelancers should read, one which explains how you need to approach freelancing if you want to succeed, and you want to keep your sanity; it's called the E-Myth Revisited. Finally, Matt discusses why networking is essential to success, and some of the mistakes that some of techies make.

### Related Links

- [The E-Myth Revisited by Michael E. Gerber](http://www.amazon.co.uk/The-E-Myth-Revisited-Michael-Gerber-ebook/dp/B000RO9VJK)
- [How to Network – Even if You’re Self-Conscious](http://www.matthewsetter.com/how-to-network-even-if-you-are-self-conscious/)

> **Correction:** Thanks to [@asgrim](https://twitter.com/@asgrim) for correcting me about employers rarely, if ever, paying for flights and hotels when sending staff to conferences. That was a slip up on my part. I'd only meant to say that they cover the costs of the ticket.

EOF;

        $fileInfo = new \SplFileInfo($filePath . '/episode-0001.md');
        $episode = $episodeLister->buildEpisode($fileInfo);

        $this->assertInstanceOf('\PodcastSite\Entity\Episode', $episode, 'Built episode is not an Episode instance');
        $this->assertNotNull($episode, 'Episode entity should have been initialised');
        $this->assertEquals('episode-0001', $episode->getSlug());
        $this->assertEquals('13.07.2015', $episode->getPublishDate());
        $this->assertEquals(
            'Episode 1 - Getting Underway, The E-Myth Revisited, and Networking For Success',
            $episode->getTitle()
        );
        $this->assertEquals(
            'http://traffic.libsyn.com/thegeekyfreelancer/FreeTheGeek-Episode0001.mp3',
            $episode->getLink()
        );
        $this->assertEquals('FreeTheGeek-Episode0001.mp3', $episode->getDownload());
        $this->assertEquals($content, $episode->getContent());
        $this->assertEquals(
            [
                "Matthew Setter" => [
                    'email' => 'matthew@matthewsetter.com',
                    'twitter' => 'settermjd'
                ]
            ],
            $episode->getGuests()
        );
    }

    /**
     * @covers ::hydrateEpisode
     */
    public function testAdapterCanProperlyHydrateEpisodeObject()
    {
        $this->markTestSkipped("Need to revisit this");

        $filePath = dirname(__FILE__) . '/../../../_data/posts';
        $episodeLister = EpisodeLister::factory([
            'type' => 'filesystem',
            'path' => $filePath,
            'parser' => new Parser()
        ]);

        $content = <<<EOF
### Synopsis

In this, the first episode, Matt talks about what lead to the podcast getting started who motivated him and inspired him to get started. After that, he discusses a fantastic book that all freelancers should read, one which explains how you need to approach freelancing if you want to succeed, and you want to keep your sanity; it's called the E-Myth Revisited. Finally, Matt discusses why networking is essential to success, and some of the mistakes that some of techies make.

### Related Links

- [The E-Myth Revisited by Michael E. Gerber](http://www.amazon.co.uk/The-E-Myth-Revisited-Michael-Gerber-ebook/dp/B000RO9VJK)
- [How to Network – Even if You’re Self-Conscious](http://www.matthewsetter.com/how-to-network-even-if-you-are-self-conscious/)

> **Correction:** Thanks to [@asgrim](https://twitter.com/@asgrim) for correcting me about employers rarely, if ever, paying for flights and hotels when sending staff to conferences. That was a slip up on my part. I'd only meant to say that they cover the costs of the ticket.

EOF;

        $episodeData = [
            'publish_date' => '2015-01-01',
            'slug' => '/episode-001',
            'title' => 'Episode 001',
            'content' => $content,
            'link' => 'http://traffic.libsyn.com/thegeekyfreelancer/FreeTheGeek-Episode0002.mp3',
            'download' => 'FreeTheGeek-Episode0002.mp3',
            'guests' => ["Matthew Setter" => ["email" => "matthew@matthewsetter.com", "twitter" => "settermjd"]],
            'fileSize' => '25925466',
            'fileType' => 'audio/x-mp3',
            'duration' => '53:50'
        ];

        $episode = $episodeLister->getEpisodeData($episodeData);

        $this->assertInstanceOf('\PodcastSite\Entity\Episode', $episode, 'Built episode is not an Episode instance');
        $this->assertNotNull($episode, 'Episode entity should have been initialised');
        $this->assertEquals($episodeData['slug'], $episode->getSlug());
        $this->assertEquals($episodeData['publish_date'], $episode->getPublishDate());
        $this->assertEquals($episodeData['title'], $episode->getTitle());
        $this->assertEquals($episodeData['link'], $episode->getLink());
        $this->assertEquals($episodeData['download'], $episode->getDownload());
        $this->assertEquals($content, $episode->getContent());
        $this->assertEquals($episodeData['guests'], $episode->getGuests());
        $this->assertEquals($episodeData['duration'], $episode->getShowDuration());
        $this->assertEquals($episodeData['fileSize'], $episode->getEpisodeFileSize());
        $this->assertEquals($episodeData['fileType'], $episode->getEpisodeFileType());
    }

    public function testEpisodeListerImplementsCorrectInterface()
    {
        $filePath = dirname(__FILE__) . '/../../../_data/posts';
        $episodeLister = EpisodeLister::factory([
            'type' => 'filesystem',
            'path' => $filePath,
            'parser' => new Parser()
        ]);
        $this->assertInstanceOf('\PodcastSite\Episodes\EpisodeListerInterface', $episodeLister);
    }

    /**
     * @covers ::__construct
     */
    public function testEpisodeListerSearchCorrectDirectory()
    {
        $filePath = dirname(__FILE__) . '/../../../_data/posts';
        $episodeLister = EpisodeLister::factory([
            'type' => 'filesystem',
            'path' => $filePath,
            'parser' => new Parser()
        ]);
        $this->assertEquals(
            $episodeLister->getDataDirectory(),
            dirname(__FILE__) . '/../../../_data/posts'
        );
    }
}