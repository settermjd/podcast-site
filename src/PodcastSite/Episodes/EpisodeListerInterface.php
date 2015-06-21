<?php

namespace PodcastSite\Episodes;

interface EpisodeListerInterface
{
    /**
     * Get the current post listing
     * @return array|\Traversable|\Iterator
     */
    public function getPosts();
}