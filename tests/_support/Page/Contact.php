<?php
namespace Page;

class Contact extends BasePage
{
    /**
     * @var string
     */
    public static $URL = '/contact';

    public function testContactPage()
    {
        $I = $this->tester;

        $I->amOnPage('/contact');
        $I->seeInTitle(sprintf('%s %s', self::SHOW_NAME, self::STRAPLINE));

        $I->seeLink("About", "/about");
        $I->seeLink("Contact", "/contact");
        $I->seeLink("For Guests", "/for-guests");

        $I->see("Got Questions");
        $I->see("If you want to get in touch with me, whether it's feedback about the show, the site, or something completely different, I'm available via the following options");
    }
}
