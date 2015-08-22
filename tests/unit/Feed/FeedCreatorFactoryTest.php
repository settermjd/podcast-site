<?php

use PodcastSite\Feed\FeedCreatorFactory;

/**
 * Class FeedCreatorFactoryTest
 *
 * @coversDefaultClass \PodcastSite\Feed\FeedCreatorFactory
 */
class FeedCreatorFactoryTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
    }

    protected function tearDown()
    {
    }

    /**
     * @covers ::factory
     */
    public function testCanInstantiateTheCorrectFeedObject()
    {
        $feedTypes = ['rss', 'atom', 'itunes'];

        foreach ($feedTypes as $type) {
            $this->assertInstanceOf(
                '\PodcastSite\Feed\iTunesFeedCreator',
                FeedCreatorFactory::factory($type),
                'Incorrect feed generator object instantiated'
            );
        }
    }
}