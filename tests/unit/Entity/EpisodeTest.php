<?php

/**
 * Class \PodcastSite\Entity\EpisodeTest
 *
 * @coversDefaultClass \PodcastSite\Entity\Episode
 */
class EpisodeTest extends \PHPUnit_Framework_TestCase
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
     * @covers ::__construct
     */
    public function testCanSetAndRetrieveUserProperties()
    {
        $options = [
            'publishDate' => '2015-01-01',
            'slug' => '/episode-001',
            'title' => 'Episode 001',
            'content' => 'Lorem ipsum dolar',
            'link' => 'http://traffic.libsyn.com/thegeekyfreelancer/FreeTheGeek-Episode0002.mp3',
            'download' => 'FreeTheGeek-Episode0002.mp3',
            'guests' => ["Matthew Setter" => ["email" => "matthew@matthewsetter.com", "twitter" => "settermjd"]]
        ];

        $episode = new \PodcastSite\Entity\Episode($options);

        $this->assertEquals($options['publishDate'], $episode->getPublishDate());
        $this->assertEquals($options['slug'], $episode->getSlug());
        $this->assertEquals($options['title'], $episode->getTitle());
        $this->assertEquals($options['content'], $episode->getContent());
        $this->assertEquals($options['link'], $episode->getLink());
        $this->assertEquals($options['download'], $episode->getDownload());
        $this->assertEquals($options['guests'], $episode->getGuests());
    }

    /**
     * @covers ::getSynopsis
     */
    public function testCanRetrieveSynopsisFromContent()
    {

        $content = <<<EOF
### Synopsis

In this, the first episode, Matt talks about what lead to the podcast getting started who motivated him and inspired him to get started. After that, he discusses a fantastic book that all freelancers should read, one which explains how you need to approach freelancing if you want to succeed, and you want to keep your sanity; it's called the E-Myth Revisited. Finally, Matt discusses why networking is essential to success, and some of the mistakes that some of techies make.

### Related Links

- [The E-Myth Revisited by Michael E. Gerber](http://www.amazon.co.uk/The-E-Myth-Revisited-Michael-Gerber-ebook/dp/B000RO9VJK)
- [How to Network – Even if You’re Self-Conscious](http://www.matthewsetter.com/how-to-network-even-if-you-are-self-conscious/)

> **Correction:** Thanks to [@asgrim](https://twitter.com/@asgrim) for correcting me about employers rarely, if ever, paying for flights and hotels when sending staff to conferences. That was a slip up on my part. I'd only meant to say that they cover the costs of the ticket.
EOF;

        $synopsis = <<<EOF
### Synopsis

In this, the first episode, Matt talks about what lead to the podcast getting started who motivated him and inspired him to get started. After that, he discusses a fantastic book that all freelancers should read, one which explains how you need to approach freelancing if you want to succeed, and you want to keep your sanity; it's called the E-Myth Revisited. Finally, Matt discusses why networking is essential to success, and some of the mistakes that some of techies make.
EOF;

        $options = [
        "publishDate" => "2015-01-01",
        "slug" => "episode-001",
        "title" => "Episode 001 Episode 001 Episode 001 Episode 001 Episode 001 Episode 001 Episode 001 Episode 001 Episode 001 Episode 001 Episode 001 Episode 001 Episode 001 Episode 001 Episode 001 Episode 001",
        "content" => $content,
        "link" => "http://traffic.libsyn.com/thegeekyfreelancer/FreeTheGeek-Episode0002.mp3",
        "download" => "FreeTheGeek-Episode0002.mp3"
        ];

        $episode = new \PodcastSite\Entity\Episode($options);

        $this->assertEquals($episode->getSynopsis(), $synopsis, "The retrieved synopsis does not match the expected value.");
    }

    /**
     * @covers ::getSynopsis
     */
    public function testReturnsFalseWhenNoSynopsisFoundOrPresent()
    {

        $content = <<<EOF
### Related Links

- [The E-Myth Revisited by Michael E. Gerber](http://www.amazon.co.uk/The-E-Myth-Revisited-Michael-Gerber-ebook/dp/B000RO9VJK)
- [How to Network – Even if You’re Self-Conscious](http://www.matthewsetter.com/how-to-network-even-if-you-are-self-conscious/)

> **Correction:** Thanks to [@asgrim](https://twitter.com/@asgrim) for correcting me about employers rarely, if ever, paying for flights and hotels when sending staff to conferences. That was a slip up on my part. I'd only meant to say that they cover the costs of the ticket.
EOF;

        $synopsis = <<<EOF
### Synopsis

In this, the first episode, Matt talks about what lead to the podcast getting started who motivated him and inspired him to get started. After that, he discusses a fantastic book that all freelancers should read, one which explains how you need to approach freelancing if you want to succeed, and you want to keep your sanity; it's called the E-Myth Revisited. Finally, Matt discusses why networking is essential to success, and some of the mistakes that some of techies make.
EOF;

        $options = [
            "publishDate" => "2015-01-01",
            "slug" => "episode-001",
            "title" => "Episode 001 Episode 001 Episode 001 Episode 001 Episode 001 Episode 001 Episode 001 Episode 001 Episode 001 Episode 001 Episode 001 Episode 001 Episode 001 Episode 001 Episode 001 Episode 001",
            "content" => $content,
            "link" => "http://traffic.libsyn.com/thegeekyfreelancer/FreeTheGeek-Episode0002.mp3",
            "download" => "FreeTheGeek-Episode0002.mp3"
        ];

        $episode = new \PodcastSite\Entity\Episode($options);

        $this->assertEquals($episode->getSynopsis(), false, "The retrieved synopsis does not match the expected value.");
    }
}
