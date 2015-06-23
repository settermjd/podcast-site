<?php

namespace PodcastSite\Entity;

/**
 * A simple value object for holding details about an Episode
 *
 * Class Episode
 * @package PodcastSite\Entity
 */
class Episode
{
    /**
     * @var string
     */
    protected $publishDate;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $content;

    /**
     * @param string $publishDate
     * @param string $slug
     * @param string $title
     * @param string $content
     */
    public function __construct($publishDate, $slug, $title, $content)
    {
        $this->publishDate = $publishDate;
        $this->slug = $slug;
        $this->title = $title;
        $this->content = $content;
    }

    /**
     * Returns a \DateTime object, which can be used to determine the publish date
     *
     * @return \DateTime
     */
    public function getPublishDate()
    {
        return $this->publishDate;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
       return $this->slug;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
       return $this->title;
    }

    /**
     * @return string
     */
    public function getContent()
    {
       return $this->content;
    }
}