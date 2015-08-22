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
        ];

        $show = new \PodcastSite\Entity\Show($options);

        $this->assertEquals($options['title'], $show->getTitle());
        $this->assertEquals($options['description'], $show->getDescription());
        $this->assertEquals($options['link'], $show->getLink());
        $this->assertEquals($options['author'], $show->getAuthor());
        $this->assertEquals($options['keywords'], $show->getKeywords());
        $this->assertEquals($options['categories'], $show->getCategories());
    }

}