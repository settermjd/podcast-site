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

    /**
     * @covers ::__construct
     */
    public function testCanSetAndRetrieveUserProperties()
    {
        $options = [
            'fileSize' => '49099054',
            'fileType' => 'audio/x-mp3',
            'duration' => '29:20',
            'publishDate' => '2015-01-01',
            'slug' => '/episode-001',
            'title' => 'Episode 001',
            'content' => 'Lorem ipsum dolar',
            'link' => 'http://traffic.libsyn.com/thegeekyfreelancer/FreeTheGeek-Episode0002.mp3',
            'download' => 'FreeTheGeek-Episode0002.mp3',
            'explicit' => 'yes',
            'guests' => [
                "Matthew Setter" => [
                    "email" => "matthew@matthewsetter.com",
                    "twitter" => "settermjd"
                ]
            ]
        ];

        $episode = new \PodcastSite\Entity\Episode($options);

        $this->assertEquals($options['publishDate'], $episode->getPublishDate());
        $this->assertEquals($options['slug'], $episode->getSlug());
        $this->assertEquals($options['title'], $episode->getTitle());
        $this->assertEquals($options['content'], $episode->getContent());
        $this->assertEquals($options['link'], $episode->getLink());
        $this->assertEquals($options['download'], $episode->getDownload());
        $this->assertEquals($options['guests'], $episode->getGuests());
        $this->assertEquals($options['fileSize'], $episode->getEpisodeFileSize());
        $this->assertEquals($options['fileType'], $episode->getEpisodeFileType());
        $this->assertEquals($options['duration'], $episode->getShowDuration());
        $this->assertTrue($episode->getExplicit() == 'yes');
    }

    /**
     * @covers ::getSynopsis
     */
    public function testCanRetrieveShortSynopsis()
    {
        $content = <<<EOF
### Synopsis

In this episode, I have a fireside chat with internationally recognized PHP expert, and all around good fella [Paul M. Jones](http://paul-m-jones.com), about one of his all-time favorite books - [The Mythical Man Month](http://www.amazon.co.uk/The-Mythical-Man-month-Software-Engineering/dp/0201835959).

We talk about why the book is so valuable to him, how it's helped shape his career over the years, and the lessons it can teach all of us as software developers, lessons still relevant over 50 years after it was first published, in 1975.

I've also got updates on what's been happening for me personally in my freelancing business; including speaking at php[world], attending the inaugural PHP South Coast, **and much, much more**.

### Related Links

- [The E-Myth Revisited by Michael E. Gerber](http://www.amazon.co.uk/The-E-Myth-Revisited-Michael-Gerber-ebook/dp/B000RO9VJK)
- [How to Network – Even if You’re Self-Conscious](http://www.matthewsetter.com/how-to-network-even-if-you-are-self-conscious/)

> **Correction:** Thanks to [@asgrim](https://twitter.com/@asgrim) for correcting me about employers rarely, if ever, paying for flights and hotels when sending staff to conferences. That was a slip up on my part. I'd only meant to say that they cover the costs of the ticket.
EOF;

        $synopsis = <<<EOF
In this episode, I have a fireside chat with internationally recognized PHP expert, and all around good fella [Paul M. Jones](http://paul-m-jones.com), about one of his all-time favorite books - [The Mythical Man Month](http://www.amazon.co.uk/The-Mythical-Man-month-Software-Engineering/dp/0201835959).
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

        $this->assertEquals($episode->getShortSynopsis(), $synopsis, "The retrieved synopsis does not match the expected value.");
    }

    /**
     * @covers ::getSynopsis
     */
    public function testCanRetrieveSynopsisFromContentStrippingHeaderTag()
    {
        $content = <<<EOF
### Synopsis

In this episode, I have a fireside chat with internationally recognized PHP expert, and all around good fella [Paul M. Jones](http://paul-m-jones.com), about one of his all-time favorite books - [The Mythical Man Month](http://www.amazon.co.uk/The-Mythical-Man-month-Software-Engineering/dp/0201835959).

We talk about why the book is so valuable to him, how it's helped shape his career over the years, and the lessons it can teach all of us as software developers, lessons still relevant over 50 years after it was first published, in 1975.

I've also got updates on what's been happening for me personally in my freelancing business; including speaking at php[world], attending the inaugural PHP South Coast, **and much, much more**.

### Related Links

- [The E-Myth Revisited by Michael E. Gerber](http://www.amazon.co.uk/The-E-Myth-Revisited-Michael-Gerber-ebook/dp/B000RO9VJK)
- [How to Network – Even if You’re Self-Conscious](http://www.matthewsetter.com/how-to-network-even-if-you-are-self-conscious/)

> **Correction:** Thanks to [@asgrim](https://twitter.com/@asgrim) for correcting me about employers rarely, if ever, paying for flights and hotels when sending staff to conferences. That was a slip up on my part. I'd only meant to say that they cover the costs of the ticket.
EOF;

        $synopsis = <<<EOF
In this episode, I have a fireside chat with internationally recognized PHP expert, and all around good fella [Paul M. Jones](http://paul-m-jones.com), about one of his all-time favorite books - [The Mythical Man Month](http://www.amazon.co.uk/The-Mythical-Man-month-Software-Engineering/dp/0201835959).

We talk about why the book is so valuable to him, how it's helped shape his career over the years, and the lessons it can teach all of us as software developers, lessons still relevant over 50 years after it was first published, in 1975.

I've also got updates on what's been happening for me personally in my freelancing business; including speaking at php[world], attending the inaugural PHP South Coast, **and much, much more**.
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

    /**
     * @covers ::getSynopsis
     */
    public function testCanRetrieveRelatedLinks()
    {
        $content = <<<EOF
### Synopsis

In this episode, I have a fireside chat with internationally recognized PHP expert, and all around good fella [Paul M. Jones](http://paul-m-jones.com), about one of his all-time favorite books - [The Mythical Man Month](http://www.amazon.co.uk/The-Mythical-Man-month-Software-Engineering/dp/0201835959).

We talk about why the book is so valuable to him, how it's helped shape his career over the years, and the lessons it can teach all of us as software developers, lessons still relevant over 50 years after it was first published, in 1975.

I've also got updates on what's been happening for me personally in my freelancing business; including speaking at php[world], attending the inaugural PHP South Coast, **and much, much more**.

### Related Links

- [The E-Myth Revisited by Michael E. Gerber](http://www.amazon.co.uk/The-E-Myth-Revisited-Michael-Gerber-ebook/dp/B000RO9VJK)
- [How to Network – Even if You’re Self-Conscious](http://www.matthewsetter.com/how-to-network-even-if-you-are-self-conscious/)

> **Correction:** Thanks to [@asgrim](https://twitter.com/@asgrim) for correcting me about employers rarely, if ever, paying for flights and hotels when sending staff to conferences. That was a slip up on my part. I'd only meant to say that they cover the costs of the ticket.
EOF;

        $links = <<<EOF
- [The E-Myth Revisited by Michael E. Gerber](http://www.amazon.co.uk/The-E-Myth-Revisited-Michael-Gerber-ebook/dp/B000RO9VJK)
- [How to Network – Even if You’re Self-Conscious](http://www.matthewsetter.com/how-to-network-even-if-you-are-self-conscious/)

> **Correction:** Thanks to [@asgrim](https://twitter.com/@asgrim) for correcting me about employers rarely, if ever, paying for flights and hotels when sending staff to conferences. That was a slip up on my part. I'd only meant to say that they cover the costs of the ticket.
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

        $this->assertEquals($episode->getRelatedLinks(), $links, "The retrieved links does not match what was expected");
    }
}
