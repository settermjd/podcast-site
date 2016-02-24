<?php
namespace Page;

class Home
{
    // include url of current page
    public static $URL = '/';

    /**
     * @var AcceptanceTester
     */
    protected $tester;

    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I;
    }

    public function testHomePage()
    {
        $I = $this->tester;

        $I->amOnPage('/');
        $I->seeInTitle('Free the Geek.fm with Matthew Setter - The podcast about the business of freelancing as a software developer, writer, content producer, and all round PHP lover');

// Test the links
        $I->seeLink("About", "/about");
        $I->seeLink("Contact", "/contact");

        $I->see("Latest Episode");
        $I->see("Upcoming Episodes");
        $I->see("Past Episodes");

// Test the subscribe buttons
        $I->seeLink('', "https://twitter.com/@freeingthegeek");
        $I->seeLink('', "https://plus.google.com/b/115002379460010233732/115002379460010233732/posts");
        $I->seeLink('', "https://www.facebook.com/pages/Free-The-Geek/899450083436065");
        $I->seeLink('', "http://freethegeek.fm/rss.xml");
        $I->seeLink('', "https://itunes.apple.com/podcast/free-geek.fm-matthew-setter/id1018923368?l=en&mt=2");

        $I->seeLink("Matthew Setter", "http://www.matthewsetter.com");
        $I->seeLink("the Slim Framework", "http://slimframework.com");
        $I->dontSeeElement("//div[@id='upcoming-episodes']//h3[@class='media-heading']/a");

    }
}
