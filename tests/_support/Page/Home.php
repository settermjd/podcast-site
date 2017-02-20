<?php
namespace Page;

class Home extends BasePage
{
    // include url of current page
    public static $URL = '/';

    public function testHomePage()
    {
        $I = $this->tester;

        $I->amOnPage('/');
        $I->seeInTitle(sprintf('%s %s', self::SHOW_NAME, self::STRAPLINE));
        $I->canSee('The podcast about building a rewarding career as a professional software developer and technical writer.', 'p[class="lead"]');

// Test the links
        $I->seeLink("About", "/about");
        $I->seeLink("Contact", "/contact");
        $I->seeLink("For Guests", "/for-guests");

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
