<?php
namespace PodcastSite\Episodes;

use PodcastSite\Episodes\Adapter\EpisodeListerFilesystem;

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
                    $options['parser']
                );
        }
    }
}