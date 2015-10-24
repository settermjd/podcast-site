<?php

namespace PodcastSite\Episodes\Adapter;

use PodcastSite\Episodes\EpisodeListerInterface;
use PodcastSite\Iterator\ActiveEpisodeFilterIterator;
use PodcastSite\Sorter\SortByReverseDateOrder;
use PodcastSite\Entity\Episode;
use PodcastSite\Iterator\UpcomingEpisodeFilterIterator;
use PodcastSite\Iterator\PastEpisodeFilterIterator;

/**
 * Class EpisodeListerFilesystem
 * @package PodcastSite\Episodes\Adapter
 */
class EpisodeListerFilesystem implements EpisodeListerInterface
{
    /**
     * @var string
     */
    const CACHE_KEY_EPISODES_LIST = 'episodes_';
    const CACHE_KEY_SUFFIX_ALL = 'all';
    const CACHE_KEY_SUFFIX_UPCOMING = 'upcoming';
    const CACHE_KEY_SUFFIX_PAST = 'past';

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
     * @var object
     */
    protected $cache;

    /** @var array  */
    protected $validOptions = [
        'publishDate' => 'publish_date',
        'slug' => 'slug',
        'title' => 'title',
        'content' => 'content',
        'link' => 'link',
        'download' => 'download',
        'guests' => 'guests',
        'duration' => 'duration',
        'fileSize' => 'fileSize',
        'fileType' => 'fileType',
        'explicit' => 'explicit',
    ];

    /**
     * @param string $postDirectory
     * @param object $fileParser Yaml/Markdown parser
     */
    public function __construct($postDirectory, $fileParser, $cache = null)
    {
        $this->postDirectory = $postDirectory;
        $this->fileParser = $fileParser;
        if (!is_null($cache)) {
            $this->cache = $cache;
        }
        $this->episodeIterator = new ActiveEpisodeFilterIterator(
            new \DirectoryIterator($this->postDirectory)
        );
    }

    /**
     * Return the current available podcast episodes
     *
     * @return array|\Traversable
     */
    public function getEpisodeList($cacheKeySuffix = self::CACHE_KEY_SUFFIX_ALL)
    {
        if ($this->cache) {
            $cacheKey = self::CACHE_KEY_EPISODES_LIST . $cacheKeySuffix;
            $result = $this->cache->getItem($cacheKey);
            if ($result) {
                return $result;
            } else {
                $result = $this->buildEpisodesList();
                $ret = $this->cache->setItem($cacheKey, $result);
                return $result;
            }
        } else {
            return $this->buildEpisodesList();
        }
    }

    public function getUpcomingEpisodes()
    {
        $list = [];
        $upcomingEpisodeIterator = new UpcomingEpisodeFilterIterator(
            new \ArrayIterator($this->getEpisodeList(self::CACHE_KEY_SUFFIX_UPCOMING))
        );
        foreach ($upcomingEpisodeIterator as $upcomingEpisode) {
            $list[] = $upcomingEpisode;
        }

        return $list;
    }

    /**
     * Get all past episodes, optionally excluding the latest
     *
     * @param bool $includeLatest Whether to include the latest episode as well
     * @todo Need to check the sort order of the episodes and limit them correctly. Currently it's starting oldest to latest, so removing from the wrong end
     * @return array
     */
    public function getPastEpisodes($includeLatest = true)
    {
        $list = [];
        $iterator = new PastEpisodeFilterIterator(
            new \ArrayIterator($this->getEpisodeList(self::CACHE_KEY_SUFFIX_PAST))
        );

        foreach ($iterator as $episode) {
            $list[] = $episode;
        }

        // Sort the records in reverse date order
        $sorter = new SortByReverseDateOrder();
        usort($list, $sorter);

        if (!$includeLatest) {
           return array_splice($list, 1);
        }

        return $list;
    }

    /**
     * Get just the first episode
     *
     * @return Episode
     */
    public function getLatestEpisode()
    {
        // just get the first one
        $episodes = $this->getPastEpisodes();
        if (!empty($episodes)) {
           return $episodes[0];
        }
    }

    /**
     * Build a list of all episodes, based on the data available in the filesystem
     *
     * @return array|\Traversable
     */
    protected function buildEpisodesList()
    {
        $episodeListing = [];
        foreach ($this->episodeIterator as $file) {
            $episodeListing[] = $this->buildEpisode($file);
        }

        return $episodeListing;
    }

    /**
     * Returns the directory being searched by the episode lister
     *
     * @return string
     */
    public function getDataDirectory()
    {
        /** @var \DirectoryIterator $iterator */
        $iterator = $this->episodeIterator->getInnerIterator();

        return $iterator->getPath();
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
            $document = $this->fileParser->parse($fileContent, false);
            if ($document->getYAML()['slug'] === $episodeSlug) {
                return new Episode($this->getEpisodeData($document));
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
    public function buildEpisode(\SplFileInfo $file)
    {
        $fileContent = file_get_contents($file->getPathname());

        /** @var \Mni\FrontYAML\Document $document */
        $document = $this->fileParser->parse($fileContent, false);

        return new Episode($this->getEpisodeData($document));
    }

    /**
     * Create an episode value object from the contents of an acceptable markdown file
     *
     * @param \Mni\FrontYAML\Document $document
     * @return Episode
     */
    public function getEpisodeData($document)
    {
        $data = [];
        foreach ($this->validOptions as $key => $value) {
            if ($key != 'content') {
                $data[$key] = (array_key_exists($value, $document->getYAML())) ? $document->getYAML()[$value] : '';
            } else {
                $data[$key] = $document->getContent();
            }
        }

        return $data;
    }

}