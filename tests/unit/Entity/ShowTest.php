<?php

/**
 * Class ShowTest
 *
 * @coversDefaultClass \PodcastSite\Entity\Show
 */
class ShowTest extends \PHPUnit_Framework_TestCase
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
    public function testCanSetAndRetrieveShowProperties()
    {
        $options = [
            'url' => 'http://freethegeek.fm/',
            'episodePrefix' => 'episodes/',
            'title' => 'Free the Geek.fm with Matthew Setter',
            'subtitle' => 'The podcast about the business of freelancing as a software developer,
            writer, content producer, and all round PHP lover',
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
            'category' => 'Technology',
            'subcategory' => 'Podcasting',
            'artwork' => 'http://traffic.libsyn.com/thegeekyfreelancer/itunes.png',
            'explicit' => 'no'
        ];

        $show = new \PodcastSite\Entity\Show($options);

        $this->assertEquals($options['url'], $show->getUrl());
        $this->assertEquals($options['episodePrefix'], $show->getEpisodePrefix());
        $this->assertEquals($options['title'], $show->getTitle());
        $this->assertEquals($options['subtitle'], $show->getSubtitle());
        $this->assertEquals($options['description'], $show->getDescription());
        $this->assertEquals($options['link'], $show->getLink());
        $this->assertEquals($options['author'], $show->getAuthor());
        $this->assertEquals($options['keywords'], $show->getKeywords());
        $this->assertEquals($options['category'], $show->getCategory());
        $this->assertEquals($options['subcategory'], $show->getSubcategory());
        $this->assertEquals($options['artwork'], $show->getArtwork());
        $this->assertTrue($show->getExplicit() == 'no', 'Explicit status not correctly set');

        $options['explicit'] = 'yes';
        $show = new \PodcastSite\Entity\Show($options);
        $this->assertTrue($show->getExplicit() == 'yes', 'Explicit status not correctly set');
    }

}