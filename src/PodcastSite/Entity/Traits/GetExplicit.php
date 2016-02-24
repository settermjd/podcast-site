<?php

namespace PodcastSite\Entity\Traits;

/**
 * Trait GetExplicit
 * As both the Show and Episode entities use this function,
 * it's being shared via a trait.
 */
/**
 * Class GetExplicit.
 *
 * @author Matthew Setter <matthew@matthewsetter.com>
 * @copyright 2015 Matthew Setter
 */
trait GetExplicit
{
    /** @var string */
    protected $explicit;

    /**
     * Is the item of an explicit nature or not.
     *
     * @return string
     */
    public function getExplicit()
    {
        return (is_null($this->explicit)) ? 'no' : $this->explicit;
    }
}
