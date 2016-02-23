<?php

namespace PodcastSite\Entity;

use PodcastSite\Entity\Traits\GetExplicit;

/**
 * Class Show
 * @package PodcastSite\Entity
 * @author Matthew Setter <matthew@matthewsetter.com>
 * @copyright 2015 Matthew Setter
 */
class Show
{
    // import the getExplicit trait
    use GetExplicit;

    /** @var string */
    const EPISODE_PREFIX = 'episode/';

    /** @var string */
    protected $url;

    /** @var string */
    protected $episodePrefix;

    /** @var string */
    protected $title;

    /** @var string */
    protected $subtitle;

    /** @var string */
    protected $artwork;

    /** @var string */
    protected $description;

    /** @var string */
    protected $link;

    /** @var array|\Traversable */
    protected $author;

    /** @var array|\Traversable */
    protected $keywords;

    /** @var string */
    protected $category;

    /** @var string */
    protected $subcategory;

    /**
     * @param array|\Traversable $options
     */
    public function __construct($options = array())
    {
        if (!empty($options)) {
            $memberVariables = get_class_vars(__CLASS__);
            foreach ($options as $key => $value) {
                if (array_key_exists($key, $memberVariables) && !empty($value)) {
                    $this->$key = $value;
                }
            }
        }

        if (!isset($this->episodePrefix)) {
            $this->episodePrefix = self::EPISODE_PREFIX;
        }
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getEpisodePrefix()
    {
        return $this->episodePrefix;
    }

    /**
     * Returns the show title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Returns the show's subtitle
     *
     * @return string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Returns the show description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the show URL
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Get the author information for the show
     *
     * At this stage I'm implementing it as a simple associative array.
     * However I'm thinking of implementing this as a simple value object
     * as well.
     *
     * @return array|\Traversable
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Get a list of keywords to tag the show with
     *
     * @return array|\Traversable
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Return the main categories for the show
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return string
     */
    public function getSubcategory()
    {
        return $this->subcategory;
    }

    /**
     * Get the show's artwork URL
     *
     * @return string
     */
    public function getArtwork()
    {
        return $this->artwork;
    }

}