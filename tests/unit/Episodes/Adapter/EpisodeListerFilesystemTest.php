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
        $this->markTestIncomplete();
        $filePath = dirname(__FILE__) . '/../../../_data/posts';
        $episodeLister = EpisodeLister::factory([
            'type' => 'filesystem',
            'path' => $filePath,
            'parser' => new Parser()
        ]);

        $content =<<<EOF
### Synopsis

In this episode I have a fireside chat about what it’s like to live the life of a developer evangelist with Jack Skinner, otherwise known as @developerjack, whilst he was at the first BuzzConf. He talked with me about the crazy hours, random locations, shared some stories from the road, such as having a conference call whilst walking down the boarding gate to catch a flight.

If you don’t, yet, know Jack, he’s a developer evangelist at MYOB, which is an Australian Software Accounting firm, the market leader I believe. He shared so much gold in this chat that I’m itching to share it with you. Here’s a summary of the key things he said.

- An evangelist works closely with the community
- He helps developers build awesome software, preferably with our (MYOB’s) platform
- You’re always still learning
- Be really passionate
- Be passionate about one particular thing and grow it from there
- Speak from the heart about what you love

He’s a very warm, genuine, and passionate person, so I know you’re going to love this episode.

### Related Links
EOF;

        $fileInfo = new \SplFileInfo($filePath . '/episode-0011.md');
        $episode = $episodeLister->buildEpisode($fileInfo);

        $this->assertInstanceOf('\PodcastSite\Entity\Episode', $episode, 'Built episode is not an Episode instance');
        $this->assertNotNull($episode, 'Episode entity should have been initialised');
        $this->assertEquals('episode-0011', $episode->getSlug());
        $this->assertEquals('21.12.2015 15:00', $episode->getPublishDate());
        $this->assertEquals(
            'Episode 11 - The Life of a Developer Evangelist, with Developer Jack',
            $episode->getTitle()
        );
        $this->assertEquals(
            'http://traffic.libsyn.com/thegeekyfreelancer/FreeTheGeek-Episode0011.mp3',
            $episode->getLink()
        );
        $this->assertEquals('FreeTheGeek-Episode0011.mp3', $episode->getDownload());
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

In this episode I have a fireside chat about what it’s like to live the life of a developer evangelist with Jack Skinner, otherwise known as @developerjack, whilst he was at the first BuzzConf. He talked with me about the crazy hours, random locations, shared some stories from the road, such as having a conference call whilst walking down the boarding gate to catch a flight.

If you don’t, yet, know Jack, he’s a developer evangelist at MYOB, which is an Australian Software Accounting firm, the market leader I believe. He shared so much gold in this chat that I’m itching to share it with you. Here’s a summary of the key things he said.

- An evangelist works closely with the community
- He helps developers build awesome software, preferably with our (MYOB’s) platform
- You’re always still learning
- Be really passionate
- Be passionate about one particular thing and grow it from there
- Speak from the heart about what you love

He’s a very warm, genuine, and passionate person, so I know you’re going to love this episode.

### Related Links
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
