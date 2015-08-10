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
     * @var string
     */
    protected $link;

    /**
     * @var string
     */
    protected $download;

    /**
     * @var string
     */
    protected $guests;

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

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @return string
     */
    public function getDownload()
    {
        return $this->download;
    }

    /**
     * Returns a comma-separated list of guests' email addresses
     *
     * @return string
     */
    public function getGuests()
    {
        return (!empty($this->guests)) ? $this->guests : false;
    }

    /**
     * Retrieves the synopsis from the Markdown content
     *
     * @return string|bool
     */
    public function getSynopsis()
    {
        // Attempt to extract just the synopsis section, with no other content
        // If you're curious about the regex, use https://regex101.com/ with some
        // sample content to see an breakdown of how it works.
        if (preg_match('/^### Synopsis(\n\n.*)*(?=###)/m', $this->content, $matches)) {
            // Strip the header
            return trim(preg_replace('/^### Synopsis(\n*)/', '', $matches[0]));
        }

        return false;
    }

    /**
     * Retrieves the a short version of the synopsis from the Markdown content
     *
     * @return string|bool
     */
    public function getShortSynopsis()
    {
        if (preg_match('/.*/m', $this->getSynopsis(), $matches)) {
            return trim($matches[0]);
        }

        return false;
    }
}