<?php

use org\bovigo\vfs\vfsStream;

class ActiveEpisodeFilterIteratorTest extends \PHPUnit_Framework_TestCase
{
    private $root;

    protected function setUp()
    {
        $this->root = vfsStream::setup();
    }

    protected function tearDown()
    {
    }

    // tests
    public function testMe()
    {
        /*$cache = new FileSystemCache($this->root->url() . '/cache');
        $this->assertTrue($this->root->hasChild('cache'));*/
    }
}
