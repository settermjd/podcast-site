<?php
namespace Page;

class Contact
{
    /**
     * @var string
     */
    public static $URL = '/contact';

    /**
     * @var AcceptanceTester
     */
    protected $tester;

    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I;
    }

    public function testContactPage()
    {
        $I = $this->tester;

        $I->amOnPage('/contact');
        $I->seeInTitle('Free the Geek.fm with Matthew Setter. The podcast about building a rewarding career as a professional software developer and technical writer.');

        $I->seeLink("About", "/about");
        $I->seeLink("Contact", "/contact");

        $I->see("Got Questions");
        $I->see("If you want to get in touch with me, whether it's feedback about the show, the site, or something completely different, I'm available via the following options");
    }
}
