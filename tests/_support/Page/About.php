<?php
namespace Page;

class About extends BasePage
{
    // include url of current page
    public static $URL = '/about';

    public function checkAboutPage()
    {
        $I = $this->tester;

        $I->amOnPage('/about');
        $I->seeInTitle(sprintf('%s %s', self::SHOW_NAME, self::STRAPLINE));

        $I->seeLink("About", "/about");
        $I->seeLink("Contact", "/contact");
        $I->seeLink("For Guests", "/for-guests");

        $I->see("In a Nutshell");
        $I->see("Why Did I Launch It?");
        $I->see("Here's What You Get");
        $I->see("My Promise To You");
    }
}
