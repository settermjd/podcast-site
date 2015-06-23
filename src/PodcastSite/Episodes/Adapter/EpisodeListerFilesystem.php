<?php

namespace PodcastSite\Episodes\Adapter;

use PodcastSite\Episodes\EpisodeListerInterface;

class EpisodeListerFilesystem implements EpisodeListerInterface
{
    protected $postDirectory;
    protected $fileParser;

    /**
     * @param string $postDirectory
     * @param object $fileParser Yaml/Markdown parser
     */
    public function __construct($postDirectory, $fileParser)
    {
        $this->postDirectory = $postDirectory;
        $this->fileParser = $fileParser;
    }

    /**
     * Return the current posts available
     */
    public function getPosts()
    {
        $episodeListing = [];

        // get the available files, then order them based on the Yaml front matter
        $dir = new \DirectoryIterator($this->postDirectory);
        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot() && $fileinfo->isFile() && $fileinfo->isReadable()) {
                if (in_array($fileinfo->getExtension(), ["md", "markdown"])) {
                    $fileContent = file_get_contents($fileinfo->getPathname());
                    /** @var \Mni\FrontYAML\Document $document */
                    $document = $this->fileParser->parse($fileContent);
                    $episodeListing[] = new \PodcastSite\Entity\Episode(
                        $document->getYAML()['publish_date'],
                        $document->getYAML()['slug'],
                        $document->getYAML()['title'],
                        $document->getContent()
                    );
                }
            }
        }

        // Sort the records in reverse date order
        $sorter = new \PodcastSite\Sorter\SortByReverseDateOrder();
        usort($episodeListing, $sorter);

        return $episodeListing;
    }

    /**
     * Sort the retrieved content based on the criteria supplied
     *
     * @param string $sortBy
     * @param string $sortDir
     */
    protected function sortListingContent($sortBy, $sortDir)
    {

    }
}