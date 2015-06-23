<?php

namespace PodcastSite\Episodes;

interface EpisodeListerInterface
{
    /**
     * Get the current post listing
     * @return array|\Traversable|\Iterator
     */
    public function getPosts();

    /**
     * Get an individual episode
     * @param string $episodeSlug
     * @return mixed
     */
    public function getEpisode($episodeSlug);
}