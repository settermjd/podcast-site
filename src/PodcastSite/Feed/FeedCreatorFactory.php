<?php

namespace PodcastSite\Feed;

use PodcastSite\Feed\iTunesFeedCreator;

class FeedCreatorFactory
{
    private function __construct(){}

    /**
     * @param string $feedType
     * @return \PodcastSite\Feed\FeedCreatorInterface
     */
    public static function factory($feedType)
    {
        switch (strtolower($feedType))
        {
            case ('itunes'):
            default:
                return new iTunesFeedCreator();
        }
    }
}