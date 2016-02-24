<?php

namespace PodcastSite\Iterator;

use PodcastSite\Entity\Episode;

/**
 * Class PastEpisodeFilterIterator.
 *
 * @author Matthew Setter <matthew@matthewsetter.com>
 * @copyright 2015 Matthew Setter
 */
class PastEpisodeFilterIterator extends \FilterIterator
{
    /**
     * @param \Iterator $iterator
     */
    public function __construct(\Iterator $iterator)
    {
        parent::__construct($iterator);
        $this->rewind();
    }

    /**
     * Determine if the current episode has a publish date of later than today.
     *
     * @return bool
     */
    public function accept()
    {
        /** @var Episode $episode */
        $episode = $this->getInnerIterator()->current();
        $today = new \DateTime();
        $episodeDate = new \DateTime($episode->getPublishDate());

        return $episodeDate <= $today;
    }
}
