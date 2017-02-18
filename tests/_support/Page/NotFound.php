<?php
namespace Page;

class NotFound extends BasePage
{
    public function check404Page()
    {
        $I = $this->tester;

        $I->amOnPage('/hello');
        $I->seeInTitle(sprintf('%s %s', self::SHOW_NAME, self::STRAPLINE));

        $I->seeLink("About", "/about");
        $I->seeLink("Contact", "/contact");

        $I->see("Oh No! That's a 404!");
    }
}
