<?php
namespace Page;

class iTunes
{
    // include url of current page
    public static $URL = '/itunes';

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

        $I->amOnPage('/itunes');
        $I->seeInCurrentUrl('/podcast/free-geek.fm-matthew-setter/id1018923368?l=en&mt=2');
    }
}
