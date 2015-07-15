<?php

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

    public function testCanSetAndRetrieveUserProperties()
    {
        $publishDate = '2015-01-01';
        $slug = '/episode-001';
        $title = 'Episode 001';
        $content = 'Lorem ipsum dolar';

        $episode = new \PodcastSite\Entity\Episode(
            $publishDate, $slug, $title, $content
        );

        $this->assertEquals($publishDate, $episode->getPublishDate());
        $this->assertEquals($slug, $episode->getSlug());
        $this->assertEquals($title, $episode->getTitle());
        $this->assertEquals($content, $episode->getContent());
    }
}
