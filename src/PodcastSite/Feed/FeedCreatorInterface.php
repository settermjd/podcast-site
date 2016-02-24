<?php

namespace PodcastSite\Feed;

/**
 * Interface FeedCreatorInterface.
 *
 * @author Matthew Setter <matthew@matthewsetter.com>
 * @copyright 2015 Matthew Setter
 */
interface FeedCreatorInterface
{
    /**
     * Generate a feed file from one or more Episode objects.
     *
     * @param \PodcastSite\Entity\Show      $show        Contains information about the show itself
     * @param \PodcastSite\Entity\Episode[] $episodeList A list of Episode objects
     *
     * @return string
     */
    public function generateFeed(\PodcastSite\Entity\Show $show, $episodeList = []);
}
