<?php
namespace Page;

class ForGuests extends BasePage
{
    public static $URL = '/for-guests';

    public function checkForGuestsPage()
    {
        $I = $this->tester;

        $I->amOnPage('/for-guests');
        $I->seeInTitle(sprintf('%s %s', self::SHOW_NAME, self::STRAPLINE));

        $I->seeLink("About", "/about");
        $I->seeLink("Contact", "/contact");
        $I->seeLink("For Guests", "/for-guests");
    }
}
