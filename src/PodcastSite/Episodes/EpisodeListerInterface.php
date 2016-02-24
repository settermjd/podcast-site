<?php

namespace PodcastSite\Episodes;

/**
 * Interface EpisodeListerInterface.
 *
 * @author Matthew Setter <matthew@matthewsetter.com>
 * @copyright 2015 Matthew Setter
 */
interface EpisodeListerInterface
{
    /**
     * Get the current post listing.
     *
     * @return array|\Traversable|\Iterator
     */
    public function getEpisodeList();

    /**
     * Get the upcoming episodes.
     *
     * @return mixed
     */
    public function getUpcomingEpisodes();

    /**
     * Get the past episodes.
     *
     * @return mixed
     */
    public function getPastEpisodes();

    /**
     * Get the latest episode.
     *
     * @return mixed
     */
    public function getLatestEpisode();

    /**
     * Get an individual episode.
     *
     * @param string $episodeSlug
     *
     * @return mixed
     */
    public function getEpisode($episodeSlug);
}
