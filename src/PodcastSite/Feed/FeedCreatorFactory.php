<?php

namespace PodcastSite\Feed;

use PodcastSite\Feed\iTunesFeedCreator;

/**
 * Class FeedCreatorFactory
 * @package PodcastSite\Feed
 * @author Matthew Setter <matthew@matthewsetter.com>
 * @copyright 2015 Matthew Setter
 */
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