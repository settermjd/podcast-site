<?php

namespace PodcastSite\Entity;

class Show
{
    /** @var string */
    protected $title;
    /** @var string */
    protected $description;
    /** @var string */
    protected $link;
    /** @var array|\Traversable */
    protected $author;
    /** @var array|\Traversable */
    protected $keywords;
    /** @var array|\Traversable */
    protected $categories;

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
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return $this->categories;
    }

}