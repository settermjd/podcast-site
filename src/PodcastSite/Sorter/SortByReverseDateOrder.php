<?php

namespace PodcastSite\Sorter;

use \PodcastSite\Entity\Episode;

/**
 * A simple invokable class to help sort a list of episodes
 *
 * Class SortByReverseDateOrder
 * @package PodcastSite\Sorter
 */
class SortByReverseDateOrder
{
    /**
     * Sort the entries in reverse date order
     *
     * @param \PodcastSite\Entity\Episode $a
     * @param \PodcastSite\Entity\Episode $b
     * @return int
     */
    public function __invoke(Episode $a, Episode $b)
    {
        if ($a->getPublishDate() == $b->getPublishDate()) {
            return 0;
        }
        return ($a->getPublishDate() > $b->getPublishDate()) ? -1 : 1;
    }
}