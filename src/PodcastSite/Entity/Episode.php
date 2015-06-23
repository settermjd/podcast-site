<?php

namespace PodcastSite\Entity;

class Episode
{
    protected $publishDate;
    protected $slug;
    protected $title;
    protected $content;

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

    public function getSlug()
    {
       return $this->slug;
    }

    public function getTitle()
    {
       return $this->title;
    }

    public function getContent()
    {
       return $this->content;
    }
}