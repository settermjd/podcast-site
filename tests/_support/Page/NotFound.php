<?php
namespace Page;

class NotFound
{
    /**
     * @var AcceptanceTester
     */
    protected $tester;

    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I;
    }

    public function check404Page()
    {
        $I = $this->tester;

        $I->amOnPage('/hello');
        $I->seeInTitle('Free the Geek.fm with Matthew Setter - The podcast about the business of freelancing as a software developer, writer, content producer, and all round PHP lover');

        $I->seeLink("About", "/about");
        $I->seeLink("Contact", "/contact");

        $I->see("Oh No! That's a 404!");
    }
}
