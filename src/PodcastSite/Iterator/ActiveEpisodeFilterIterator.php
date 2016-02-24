<?php

namespace PodcastSite\Iterator;

/**
 * Class ActiveEpisodeFilterIterator.
 *
 * @author Matthew Setter <matthew@matthewsetter.com>
 * @copyright 2015 Matthew Setter
 */
class ActiveEpisodeFilterIterator extends \FilterIterator
{
    /**
     * @param \DirectoryIterator $iterator
     */
    public function __construct(\DirectoryIterator $iterator)
    {
        parent::__construct($iterator);
        $this->rewind();
    }

    /**
     * Determine what is a valid element in this iterator.
     *
     * @return bool
     */
    public function accept()
    {
        /** @var \SplFileInfo $item */
        $item = $this->getInnerIterator()->current();

        if (!$item instanceof \SplFileInfo) {
            return false;
        }

        if ($item->isDot() || !$item->isFile() || !$item->isReadable()) {
            return false;
        }

        if (!in_array($item->getExtension(), ['md', 'markdown'])) {
            return false;
        }

        return true;
    }
}
