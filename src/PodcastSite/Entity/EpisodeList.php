<?php

namespace PodcastSite\Entity;

class EpisodeList extends \SplMaxHeap
{
    public function compare($episodeOne, $episodeTwo)
    {
        $first = new \DateTime($episodeOne->getPublishDate());
        $second = new \DateTime($episodeTwo->getPublishDate());

        if ($first == $second) {
            return 0;
        }
        return ($first > $second) ? 1 : -1;
    }
}