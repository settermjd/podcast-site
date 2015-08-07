<?php

/**
 * Class SortByReverseDateOrderTest
 *
 * @coversDefaultClass \PodcastSite\Sorter\SortByReverseDateOrder
 */
class SortByReverseDateOrderTest extends \PHPUnit_Framework_TestCase
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
     * @covers ::__invoke
     */
    public function testResultsAreSortedInTheCorrectOrder()
    {
        $episodeListing = [
            new \PodcastSite\Entity\Episode([
                'publishDate' => '2013-01-01'
            ]),
            new \PodcastSite\Entity\Episode([
                'publishDate' => '2015-01-01'
            ]),
            new \PodcastSite\Entity\Episode([
                'publishDate' => '2014-01-01'
            ]),
        ];

        // Sort the records in reverse date order
        $sorter = new \PodcastSite\Sorter\SortByReverseDateOrder();
        usort($episodeListing, $sorter);

        /** @var \PodcastSite\Entity\Episode $episode */
        $episode = array_shift($episodeListing);
        $this->assertEquals('2015-01-01', $episode->getPublishDate());
        $episode = array_shift($episodeListing);
        $this->assertEquals('2014-01-01', $episode->getPublishDate());
        $episode = array_shift($episodeListing);
        $this->assertEquals('2013-01-01', $episode->getPublishDate());
    }
}
