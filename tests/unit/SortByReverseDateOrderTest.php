<?php

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

    public function testResultsAreSortedInTheCorrectOrder()
    {
        $episodeListing = [
            new \PodcastSite\Entity\Episode('2013-01-01', '', '', ''),
            new \PodcastSite\Entity\Episode('2015-01-01', '', '', ''),
            new \PodcastSite\Entity\Episode('2014-01-01', '', '', ''),
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
