<?php

use PodcastSite\Feed\iTunesFeedCreator;
use PodcastSite\Entity\Show;

/**
 * Class iTunesFeedCreatorTest
 *
 * @coversDefaultClass \PodcastSite\Feed\iTunesFeedCreator
 */
class iTunesFeedCreatorTest extends \PHPUnit_Framework_TestCase
{
    protected $episodeList = [];
    protected $show;

    protected function setUp()
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

        $options = [
            "publishDate" => "03.08.2015",
            "slug" => "episode-002",
            "title" => "The Mythical Man Month with Paul M. Jones & Speaking Engagements",
            "content" => $content,
            "link" => "http://traffic.libsyn.com/thegeekyfreelancer/FreeTheGeek-Episode0002.mp3",
            "download" => "FreeTheGeek-Episode0002.mp3"
        ];

        $this->episodeList[] = new \PodcastSite\Entity\Episode($options);

        $content = <<<EOF
### Synopsis

In this episode, I have a fireside chat with voice of the PHP community, the one and only, [Cal Evans](http://blog.calevans.com/), about one of his books - [Going Pro](https://leanpub.com/goingpro).

We talk about a range of things, including what motivated him to write the book, how the book's been received, people Cal believes are excellent examples of professional programmers, **and much, much more**. Join me for what is a truly excellent fireside chat about some of the key aspects of being a professional.

### Related Links

- [Cal Evans](http://blog.calevans.com/)
- [Going Pro](https://leanpub.com/goingpro)
- [Culture of Respect](https://leanpub.com/cultureofrespect)
- [NomadPHP](http://nomadphp.com/)
EOF;

        $options = [
            "publishDate" => "17.08.2015",
            "slug" => "episode-002",
            "title" => "Being a Professional Developer - with Cal Evans",
            "content" => $content,
            "link" => "http://traffic.libsyn.com/thegeekyfreelancer/FreeTheGeek-Episode0003.mp3",
            "download" => "FreeTheGeek-Episode0003.mp3"
        ];

        $this->episodeList[] = new \PodcastSite\Entity\Episode($options);

        $this->show = new Show([
            'title' => 'Free the Geek.fm with Matthew Setter',
            'description' => 'A fireside chat on the ins and outs of being a freelance writer, screencaster,
            teacher, and software developer. Looking at what it’s like to do it, warts and all, as
            well as how to get started, what to expect, the good, the bad, and the ugly. When we’re
            not talking that, we’re talking tech, code, apps, development, and of course PHP.',
            'link' => 'http://www.freethegeek.fm',
            'author' => [
                'name' => 'FreetheGeek.fm with Matthew Setter',
                'email' => 'matthew@freethegeek.fm'
            ],
            'keywords' => [
                'Freelancing'
            ],
            'categories' => [
                'Podcasting'
            ],
        ]);
    }

    protected function tearDown()
    {
        $this->episodeList = [];
    }

    /**
     * @covers ::generateFeed
     */
    public function testCanCreateTheCorrectFeedFile()
    {
        $feedFile = file_get_contents(__DIR__ . '/../../../tests/_data/rss.xml');
        $feedCreator = new iTunesFeedCreator();
        $feed = $feedCreator->generateFeed($this->show, $this->episodeList);
        $this->assertSame(
            $feedFile,
            $feed->generate('rss2'),
            "The generated feed differs from the expected result"
        );
    }
}