<?php

namespace PodcastSite\Episodes;

interface EpisodeListerInterface
{
    /**
     * Get the current post listing
     * @return array|\Traversable|\Iterator
     */
    public function getEpisodeList();

    public function getUpcomingEpisodes();

    public function getPastEpisodes();

    public function getLatestEpisode();

    /**
     * Get an individual episode
     * @param string $episodeSlug
     * @return mixed
     */
    public function getEpisode($episodeSlug);
}