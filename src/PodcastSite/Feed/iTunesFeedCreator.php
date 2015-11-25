<?php

namespace PodcastSite\Feed;

use \PodcastSite\Entity\Show;
use ezcFeed;

/**
 * Class iTunesFeedCreator
 * @package PodcastSite\Feed
 * @author Matthew Setter <matthew@matthewsetter.com>
 * @copyright 2015 Matthew Setter
 */
class iTunesFeedCreator implements FeedCreatorInterface
{
    /**
     * Generate a feed file from one or more Episode objects
     *
     * @param \PodcastSite\Entity\Show $show Contains information about the show itself
     * @param \PodcastSite\Entity\Episode[] $episodeList A list of Episode objects
     * @return ezcFeed
     */
    public function generateFeed(Show $show, $episodeList = [])
    {
        $feed = new ezcFeed('rss2');

        // Setup the core show information
        $feed->title = $this->cDataEncapsulate($show->getTitle());
        $feed->description = $this->cDataEncapsulate($show->getDescription());

        // Add the author information.
        $author = $feed->add('author');
        $author->name = $show->getAuthor()['name'];
        $author->email = $show->getAuthor()['email'];

        // Add the link information.
        $link = $feed->add('link');
        $link->href = $show->getLink();

        // Add the iTunes-specific information.
        $iTunes = $feed->addModule('iTunes');
        $iTunes->keywords = implode(',', $show->getKeywords());
        $iTunes->explicit = $show->getExplicit();
        $iTunes->subtitle = $show->getSubtitle();

        // Add the show's artwork
        $image = $iTunes->add('image');
        $image->link = $show->getArtwork();

        // Add the podcast in the category and sub-category
        $category = $iTunes->add('category');
        $category->term = $show->getCategory();
        $subCategory = $category->add('category');
        $subCategory->term = $show->getSubcategory();

        // Add show episodes
        foreach ($episodeList as $episode) {
            $item = $feed->add('item');
            $item->title = $this->cDataEncapsulate($episode->getTitle());
            $item->description = $this->cDataEncapsulate($episode->getShortSynopsis());
            $publishDate = new \DateTime($episode->getPublishDate());
            $item->published = $publishDate->format('r');

            $author = $item->add('author');
            $author->name = $show->getAuthor()['name'];
            $author->email = $show->getAuthor()['email'];

            $link = $item->add('link');
            $link->href = $show->getUrl() . $show->getEpisodePrefix() . $episode->getSlug();

            $enclosure = $item->add('enclosure');
            $enclosure->url = $episode->getLink();
            $enclosure->length = $episode->getEpisodeFileSize(); // bytes
            $enclosure->type = $episode->getEpisodeFileType();

            $iTunes = $item->addModule( 'iTunes' );
            $iTunes->duration = $episode->getShowDuration();
            $iTunes->keywords = $this->cDataEncapsulate(implode(',', $show->getKeywords()));
            $iTunes->subtitle = $episode->getShortSynopsis();
            $iTunes->summary = $episode->getShortSynopsis();
            $iTunes->explicit = $episode->getExplicit();
        }

        return $feed;
    }

    /**
     * Simple encapsulation of string in CDATA tag
     *
     * @param $data
     * @return string
     */
    public function cDataEncapsulate($data)
    {
        return sprintf("%s", htmlentities($data));
    }
}