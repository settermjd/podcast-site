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
        $publishDate = '2015-01-01';
        $slug = '/episode-001';
        $title = 'Episode 001';
        $content = 'Lorem ipsum dolar';

        $episode = new \PodcastSite\Entity\Episode(
            $publishDate, $slug, $title, $content
        );

        $this->assertEquals($publishDate, $episode->getPublishDate());
        $this->assertEquals($slug, $episode->getSlug());
        $this->assertEquals($title, $episode->getTitle());
        $this->assertEquals($content, $episode->getContent());
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

        $episode = new \PodcastSite\Entity\Episode(
            $publishDate, $slug, $title, $content
        );

        //$this->assertTrue((strlen($episode->getTitle()) <= 150), strlen($episode->getTitle()));
        //$this->assertTrue((strlen($episode->getContent()) <= 500), strlen($episode->getContent()));
    }
}
