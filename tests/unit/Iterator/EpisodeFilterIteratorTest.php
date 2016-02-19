<?php

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use PodcastSite\Episodes\EpisodeLister;
use PodcastSite\Iterator\PastEpisodeFilterIterator;
use Mni\FrontYAML\Parser;

class EpisodeFilterIteratorTest extends \PHPUnit_Framework_TestCase
{
    private $root;
    private $structure;

    protected function setUp()
    {
        $episode001Content = <<<EOF
---
publish_date: 13.07.2015
slug: episode-0001
title: Getting Underway, The E-Myth Revisited, and Networking For Success
link: http://traffic.libsyn.com/thegeekyfreelancer/FreeTheGeek-Episode0001.mp3
download: FreeTheGeek-Episode0001.mp3
guests:

---
### Synopsis

In this, the first episode, Matt talks about what lead to the podcast getting started who motivated him and inspired him to get started. After that, he discusses a fantastic book that all freelancers should read.

It's one which explains how you need to approach freelancing if you want to succeed, and you want to keep your sanity; it's called the E-Myth Revisited. Finally, Matt discusses why networking is essential to success, and some of the mistakes that some of techies make.

### Related Links

- [The E-Myth Revisited by Michael E. Gerber](http://www.amazon.co.uk/The-E-Myth-Revisited-Michael-Gerber-ebook/dp/B000RO9VJK)
- [How to Network – Even if You’re Self-Conscious](http://www.matthewsetter.com/how-to-network-even-if-you-are-self-conscious/)

> **Correction:** Thanks to [@asgrim](https://twitter.com/@asgrim) for correcting me about employers rarely, if ever, paying for flights and hotels when sending staff to conferences. That was a slip up on my part. I'd only meant to say that they cover the costs of the ticket.
EOF;

        $episode002Content = <<<EOF
---
publish_date: 03.08.2015
slug: episode-0002
title: The Mythical Man Month with Paul M. Jones & Speaking Engagements
link: http://traffic.libsyn.com/thegeekyfreelancer/FreeTheGeek-Episode0002.mp3
download: FreeTheGeek-Episode0002.mp3
guests:
    "Paul M. Jones":
        email: pmjones88@gmail.com
        twitter: pmjones

---
### Synopsis

In this episode, I have a fireside chat with internationally recognized PHP expert, and all around good fella [Paul M. Jones](http://paul-m-jones.com), about one of his all-time favorite books - [The Mythical Man Month](http://www.amazon.co.uk/The-Mythical-Man-month-Software-Engineering/dp/0201835959).

We talk about why the book is so valuable to him, how it's helped shape his career over the years, and the lessons it can teach all of us as software developers, lessons still relevant over 50 years after it was first published, in 1975.

I've also got updates on what's been happening for me personally in my freelancing business; including speaking at php[world], attending the inaugural PHP South Coast, **and much, much more**.

### Related Links

- [Paul M. Jones](http://paul-m-jones.com/)
- [Modernizing Legacy Applications in PHP](http://mlaphp.com/)
- [Solving the N+1 Problem in PHP](https://leanpub.com/sn1php?utm_campaign=sn1php&utm_medium=embed&utm_source=paul-m-jones.com)
- [The Action Domain Responder Pattern](http://pmjones.io/adr/)
- [The Mythical Man Month, by Frederick P. Brooks. Jr](http://www.amazon.co.uk/The-Mythical-Man-month-Software-Engineering/dp/0201835959)
- [Peopleware: Productive Projects and Teams](http://www.amazon.co.uk/Peopleware-Productive-Projects-Tom-DeMarco/dp/0932633439)
- [The Inmates are Running the Asylum](http://www.amazon.co.uk/The-Inmates-are-Running-Asylum/dp/0672326140)
- [Outliers by Malcolm Gladwell](http://gladwell.com/outliers/)
- [PHP South Coast Conference](http://2015.phpsouthcoast.co.uk/)
- [PHP[World] Conference](http://world.phparch.com)
- [Nomad PHP](https://nomadphp.com)
EOF;

        $episode003Content = <<<EOF
---
publish_date: %s
slug: episode-0003
title: The Mythical Man Month with Paul M. Jones & Speaking Engagements
link: http://traffic.libsyn.com/thegeekyfreelancer/FreeTheGeek-Episode0002.mp3
download: FreeTheGeek-Episode0002.mp3
guests:
    "Paul M. Jones":
        email: cal@calevans.com
        twitter: calevans

---
### Synopsis

In this episode, I have a fireside chat with internationally recognized PHP expert, and all around good fella [Paul M. Jones](http://paul-m-jones.com), about one of his all-time favorite books - [The Mythical Man Month](http://www.amazon.co.uk/The-Mythical-Man-month-Software-Engineering/dp/0201835959).

We talk about why the book is so valuable to him, how it's helped shape his career over the years, and the lessons it can teach all of us as software developers, lessons still relevant over 50 years after it was first published, in 1975.

I've also got updates on what's been happening for me personally in my freelancing business; including speaking at php[world], attending the inaugural PHP South Coast, **and much, much more**.

### Related Links

- [Paul M. Jones](http://paul-m-jones.com/)
EOF;

        $futureDate = (new \DateTime())->add(new \DateInterval('P3D'))->format('d.m.Y');
        $episode003Content = sprintf($episode003Content, $futureDate);

        $episode004Content = <<<EOF
---
publish_date: %s
slug: episode-0004
title: Wisdom as a Service World Tour and Human Skills - with Yitzchok Willroth
link: http://traffic.libsyn.com/thegeekyfreelancer/FreeTheGeek-Episode0004.mp3
download: FreeTheGeek-Episode0004.mp3
guests:
    "Yitzchok Willroth":
        email: yitz@coderabbi.me
        twitter: coderabbi

---
### Synopsis

In this episode, I have a fireside chat with Yitzchok Willroth, the one and only [coderabbi](https://twitter.com/@coderabbi), about a his [Wisdom as a Service World Tour](http://wisdomworldtour.com/).

We talk about what it's like to run the tour, the time involved, the energy required, and how it's been received. We also talk about the value of human skills (otherwise known as soft skills), the value of getting up and sharing your knowledge with the community, via public speaking, **and much, much more**.

### Related Links

- [Wisdom as a Service World Tour](http://wisdomworldtour.com/)
- [coderabbi](https://twitter.com/@coderabbi)
- [ShorePHP User Group](http://shorephp.org/)
- [NYPHP User Group](http://nyphp.org/)
EOF;

        $futureDate = (new \DateTime())->add(new \DateInterval('P5D'))->format('d.m.Y');
        $episode004Content = sprintf($episode004Content, $futureDate);

        $this->root = vfsStream::setup();
        // setup the directory structure
        $this->structure = [
            'posts' => [
                'episode-0001.md' => $episode001Content,
                'episode-0002.md' => $episode002Content,
                'episode-0003.md' => $episode003Content,
                'episode-0004.md' => $episode004Content,
            ],
        ];
    }

    protected function tearDown()
    {
    }

    public function testCanFilterUpcomingEpisodes()
    {
        /** @var vfsStreamDirectory $directory */
        vfsStream::setup('root', null, $this->structure);

        $episodeLister = EpisodeLister::factory([
            'type' => 'filesystem',
            'path' => vfsStream::url('root/posts'),
            'parser' => new Parser()
        ]);

        $this->assertTrue(
            count($episodeLister->getUpcomingEpisodes()) == 2,
            "Incorrect upcoming episode count retrieved"
        );
    }

    public function testCanRenderUpcomingEpisodesOrderedByDate()
    {
        /** @var vfsStreamDirectory $directory */
        vfsStream::setup('root', null, $this->structure);

        $episodeLister = EpisodeLister::factory([
            'type' => 'filesystem',
            'path' => vfsStream::url('root/posts'),
            'parser' => new Parser()
        ]);

        /** @var \PodcastSite\Entity\Episode[] $upcomingEpisodes */
        $upcomingEpisodes = $episodeLister->getUpcomingEpisodes();

        $this->assertTrue(
            $upcomingEpisodes[0]->getPublishDate() < $upcomingEpisodes[1]->getPublishDate(),
            "The upcoming episodes are not sorted in ascending publish date order"
        );
    }

    public function testCanGetAllPastEpisodes()
    {
        /** @var vfsStreamDirectory $directory */
        vfsStream::setup('root', null, $this->structure);

        $episodeLister = EpisodeLister::factory([
            'type' => 'filesystem',
            'path' => vfsStream::url('root/posts'),
            'parser' => new Parser()
        ]);

        $this->assertTrue(count($episodeLister->getPastEpisodes()) == 2, "Incorrect past episode count retrieved");
    }

    public function testCanGetAllPastEpisodesMinusLatest()
    {
        /** @var vfsStreamDirectory $directory */
        vfsStream::setup('root', null, $this->structure);

        $episodeLister = EpisodeLister::factory([
            'type' => 'filesystem',
            'path' => vfsStream::url('root/posts'),
            'parser' => new Parser()
        ]);

        $this->assertTrue(
            count($episodeLister->getPastEpisodes(false)) == 1,
            "Incorrect past episode count retrieved"
        );
    }

    public function testCanFilterLatestEpisodes()
    {
        /** @var vfsStreamDirectory $directory */
        vfsStream::setup('root', null, $this->structure);

        $episodeLister = EpisodeLister::factory([
            'type' => 'filesystem',
            'path' => vfsStream::url('root/posts'),
            'parser' => new Parser()
        ]);

        $this->assertInstanceOf(
            '\PodcastSite\Entity\Episode',
            $episodeLister->getLatestEpisode(),
            "Incorrect past episode count retrieved"
        );
    }
}
