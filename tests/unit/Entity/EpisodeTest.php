<?php

class EpisodeTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
    }

    protected function tearDown()
    {
    }

    // tests
    public function testMe()
    {
    }

    public function testCanSetAndRetrieveUserProperties()
    {
        $options = [
            'publishDate' => '2015-01-01',
            'slug' => '/episode-001',
            'title' => 'Episode 001',
            'content' => 'Lorem ipsum dolar',
            'link' => 'http://traffic.libsyn.com/thegeekyfreelancer/FreeTheGeek-Episode0002.mp3',
            'download' => 'FreeTheGeek-Episode0002.mp3'
        ];

        $episode = new \PodcastSite\Entity\Episode($options);

        $this->assertEquals($options['publishDate'], $episode->getPublishDate());
        $this->assertEquals($options['slug'], $episode->getSlug());
        $this->assertEquals($options['title'], $episode->getTitle());
        $this->assertEquals($options['content'], $episode->getContent());
        $this->assertEquals($options['link'], $episode->getLink());
        $this->assertEquals($options['download'], $episode->getDownload());
    }

    public function testHydratedMarkdownDataIsCorrectlyFiltered()
    {
        $publishDate = '2015-01-01';
        $slug = '/episode-001';
        $title = 'Episode 001 Episode 001 Episode 001 Episode 001 Episode 001 Episode 001 Episode 001 Episode 001 Episode 001 Episode 001 Episode 001 Episode 001 Episode 001 Episode 001 Episode 001 Episode 001';
        $content = 'Permission is hereby granted, free of charge, to any person obtaining a copy of
this software and associated documentation files (the "Software"), to deal in
the Software without restriction, including without limitation the rights to
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies
of the Software, and to permit persons to whom the Software is furnished to do
so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.';
        $link = 'http://traffic.libsyn.com/thegeekyfreelancer/FreeTheGeek-Episode0002.mp3';
        $download = 'FreeTheGeek-Episode0002.mp3';

        $episode = new \PodcastSite\Entity\Episode(array());

        //$this->assertTrue((strlen($episode->getTitle()) <= 150), strlen($episode->getTitle()));
        //$this->assertTrue((strlen($episode->getContent()) <= 500), strlen($episode->getContent()));
    }
}
