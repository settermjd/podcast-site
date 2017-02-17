<?php
namespace Page;

class About
{
    // include url of current page
    public static $URL = '/about';

    /**
     * @var AcceptanceTester
     */
    protected $tester;

    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I;
    }

    public function checkAboutPage()
    {
        $I = $this->tester;

        $I->amOnPage('/about');
        $I->seeInTitle('Free the Geek.fm with Matthew Setter. The podcast about the business of freelancing as a software developer, writer, content producer, and all round PHP lover');

        $I->seeLink("About", "/about");
        $I->seeLink("Contact", "/contact");

        $I->see("In a Nutshell");
        $I->see("Why Did I Launch It?");
        $I->see("Here's What You Get");
        $I->see("My Promise To You");
    }
}
