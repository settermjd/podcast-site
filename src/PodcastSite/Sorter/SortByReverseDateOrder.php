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
     * @param Episode $a
     * @param Episode $b
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