<?php

use PodcastSite\Episodes\EpisodeLister;
use Mni\FrontYAML\Parser;
use \Mockery as m;

class EpisodeListerFilesystemTest extends \Codeception\TestCase\Test
{
    use \Codeception\Specify;

    /**
     * @var \UnitTester
     */
    protected $tester;

    /** @var  \PodcastSite\Episodes\Adapter\EpisodeListerFilesystem */
    protected $episodeLister;

    /** @var  array */
    protected $documentData;
    protected $episodeData;
    protected $content;

    protected function _before()
    {
        $this->content = <<<EOF
### Synopsis

In this, the first episode, Matt talks about what lead to the podcast getting started who motivated him and inspired him to get started. After that, he discusses a fantastic book that all freelancers should read, one which explains how you need to approach freelancing if you want to succeed, and you want to keep your sanity; it's called the E-Myth Revisited. Finally, Matt discusses why networking is essential to success, and some of the mistakes that some of techies make.

### Related Links

- [The E-Myth Revisited by Michael E. Gerber](http://www.amazon.co.uk/The-E-Myth-Revisited-Michael-Gerber-ebook/dp/B000RO9VJK)
- [How to Network – Even if You’re Self-Conscious](http://www.matthewsetter.com/how-to-network-even-if-you-are-self-conscious/)

> **Correction:** Thanks to [@asgrim](https://twitter.com/@asgrim) for correcting me about employers rarely, if ever, paying for flights and hotels when sending staff to conferences. That was a slip up on my part. I'd only meant to say that they cover the costs of the ticket.

EOF;

        $filePath = dirname(__FILE__) . '/../_data/posts';
        $this->episodeLister = EpisodeLister::factory([
            'type' => 'filesystem',
            'path' => $filePath,
            'parser' => new Parser()
        ]);
        $this->documentData = [
            'publish_date' => '13.07.2015 03:00',
            'slug' => 'episode-0001',
            'title' => 'Getting Underway, The E-Myth Revisited, and Networking For Success',
            'content' => $this->content,
            'link' => 'http://traffic.libsyn.com/thegeekyfreelancer/FreeTheGeek-Episode0001.mp3',
            'download' => 'FreeTheGeek-Episode0001.mp3',
            'guests' => '',
            'duration' => '26:06',
            'fileSize' => '37676715',
            'fileType' => 'audio/x-mp3',
            'explicit' => 'no',
        ];
        $this->episodeData = [
            'publishDate' => '13.07.2015 03:00',
            'slug' => 'episode-0001',
            'title' => 'Getting Underway, The E-Myth Revisited, and Networking For Success',
            'content' => $this->content,
            'link' => 'http://traffic.libsyn.com/thegeekyfreelancer/FreeTheGeek-Episode0001.mp3',
            'download' => 'FreeTheGeek-Episode0001.mp3',
            'guests' => '',
            'duration' => '26:06',
            'fileSize' => '37676715',
            'fileType' => 'audio/x-mp3',
            'explicit' => 'no',
        ];
    }

    protected function _after()
    {
        m::close();
    }

    // tests
    public function testCanGetEpisodeDataFromEpisodeFile()
    {
        $service = m::mock('\Mni\FrontYAML\Document');
        $service->shouldReceive('getYAML')
            ->times(20)
            ->andReturn(
                $this->documentData, $this->documentData, $this->documentData,
                $this->documentData, $this->documentData, $this->documentData,
                $this->documentData, $this->documentData, $this->documentData,
                $this->documentData, $this->documentData
            );
        $service->shouldReceive('getContent')
            ->times(1)
            ->andReturn($this->content);

        $this->specify("Test data retrieved from getEpisodeData is correct", function () use($service) {
            verify($this->episodeLister->getEpisodeData($service))->equals($this->episodeData);
        });

    }
}