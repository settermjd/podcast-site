<?php

namespace PodcastSite\Entity;

use PodcastSite\Entity\Traits\GetExplicit;

/**
 * A simple value object for holding details about an Episode.
 *
 * Class Episode
 */
class Episode
{
    // import the getExplicit trait
    use GetExplicit;

    /** @var string */
    const HEADER_RELATED_LINKS = 'Related Links';

    /** @var string */
    const HEADER_SYNOPSIS = 'Synopsis';

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
     * @var int
     */
    protected $fileSize;

    /**
     * @var string
     */
    protected $fileType;

    /**
     * @var string
     */
    protected $duration;

    /**
     * @param array|\Traversable $options
     */
    public function __construct($options = [])
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
     * Returns a \DateTime object, which can be used to determine the publish date.
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
     * Returns a comma-separated list of guests' email addresses.
     *
     * @return string
     */
    public function getGuests()
    {
        return (!empty($this->guests)) ? $this->guests : false;
    }

    /**
     * Retrieves the synopsis from the Markdown content.
     *
     * @return string|bool
     */
    public function getSynopsis()
    {
        // Attempt to extract just the synopsis section, with no other content
        // If you're curious about the regex, use https://regex101.com/ with some
        // sample content to see an breakdown of how it works.
        if (preg_match('/### Synopsis(\n.*)+(?=###)/', $this->content, $matches)) {
            // Strip the header
            return trim(preg_replace('/^### Synopsis(\n*)/', '', $matches[0]));
        }

        return false;
    }

    /**
     * Retrieves the a short version of the synopsis from the Markdown content.
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

    /**
     * Retrieves the related links section from the Markdown content.
     *
     * @return string|bool
     */
    public function getRelatedLinks()
    {
        // Attempt to extract just the synopsis section, with no other content
        // If you're curious about the regex, use https://regex101.com/ with some
        // sample content to see an breakdown of how it works.
        if (preg_match("/^### Related Links\n\n.*(\n.*)*/mi", $this->content, $matches)) {
            // Strip the header
            return trim(
                preg_replace("/^### Related Links(\n*)/", '', $matches[0])
            );
        }

        return false;
    }

    /**
     * @return int
     */
    public function getEpisodeFileSize()
    {
        return $this->fileSize;
    }

    /**
     * @return string
     */
    public function getEpisodeFileType()
    {
        return $this->fileType;
    }

    /**
     * @return string
     */
    public function getShowDuration()
    {
        return $this->duration;
    }
}
