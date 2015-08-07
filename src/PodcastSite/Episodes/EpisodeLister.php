<?php
namespace PodcastSite\Episodes;

use PodcastSite\Episodes\Adapter\EpisodeListerFilesystem;

/**
 * Class EpisodeLister
 * @package PodcastSite\Episodes
 */
class EpisodeLister
{
    /**
     * @param array|\Traversable|\Iterator $options
     * @return \PodcastSite\Episodes\Adapter\EpisodeListerFilesystem
     */
    public static function factory($options = array())
    {
        switch ($options['type'])
        {
            case ('filesystem'):
            default:
                return new EpisodeListerFilesystem(
                    $options['path'],
                    $options['parser'],
                    (array_key_exists('cache', $options)) ? $options['cache'] : ''
                );
        }
    }
}