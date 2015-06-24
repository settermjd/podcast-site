<?php

namespace PodcastSite\Iterator;

class ActiveEpisodeFilterIterator extends \FilterIterator
{
    public function __construct(\DirectoryIterator $iterator)
    {
        parent::__construct($iterator);
        $this->rewind();
    }

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

        if (!in_array($item->getExtension(), ["md", "markdown"])) {
            return false;
        }

        return true;
    }
}