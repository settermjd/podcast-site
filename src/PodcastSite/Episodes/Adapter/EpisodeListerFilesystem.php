<?php

namespace PodcastSite\Episodes\Adapter;

use PodcastSite\Episodes\EpisodeListerInterface;
use PodcastSite\Iterator\ActiveEpisodeFilterIterator;

/**
 * Class EpisodeListerFilesystem
 * @package PodcastSite\Episodes\Adapter
 */
class EpisodeListerFilesystem implements EpisodeListerInterface
{
    /**
     * @var string
     */
    protected $postDirectory;

    /**
     * @var object
     */
    protected $fileParser;

    /**
     * @var ActiveEpisodeFilterIterator
     */
    protected $episodeIterator;

    /**
     * @param string $postDirectory
     * @param object $fileParser Yaml/Markdown parser
     */
    public function __construct($postDirectory, $fileParser)
    {
        $this->postDirectory = $postDirectory;
        $this->fileParser = $fileParser;
        $this->episodeIterator = new ActiveEpisodeFilterIterator(
            new \DirectoryIterator($this->postDirectory)
        );
    }

    /**
     * Return the current posts available
     */
    public function getPosts()
    {
        $episodeListing = [];
        foreach ($this->episodeIterator as $file) {
            $episodeListing[] = $this->buildEpisode($file);
        }

        // Sort the records in reverse date order
        $sorter = new \PodcastSite\Sorter\SortByReverseDateOrder();
        usort($episodeListing, $sorter);

        return $episodeListing;
    }

    /**
     * Get details of one episode
     *
     * @param \PodcastSite\Entity\Episode|null $episode
     */
    public function getEpisode($episodeSlug)
    {
        foreach ($this->episodeIterator as $file) {
            $fileContent = file_get_contents($file->getPathname());
            /** @var \Mni\FrontYAML\Document $document */
            $document = $this->fileParser->parse($fileContent);
            if ($document->getYAML()['slug'] === $episodeSlug) {
                return new Episode(
                    $document->getYAML()['publish_date'],
                    $document->getYAML()['slug'],
                    $document->getYAML()['title'],
                    $document->getContent()
                );
            }
        }

        return null;
    }

    /**
     * Create an episode value object from the contents of an acceptable markdown file
     *
     * @param \SplFileInfo $file
     * @return \PodcastSite\Entity\Episode
     */
    protected function buildEpisode(\SplFileInfo $file)
    {
        $fileContent = file_get_contents($file->getPathname());

        /** @var \Mni\FrontYAML\Document $document */
        $document = $this->fileParser->parse($fileContent);

        return new Episode(
            $document->getYAML()['publish_date'],
            $document->getYAML()['slug'],
            $document->getYAML()['title'],
            $document->getContent()
        );
    }

}