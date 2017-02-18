<?php
/**
 * Created by PhpStorm.
 * User: settermjd
 * Date: 18/02/2017
 * Time: 10:39
 */

namespace Page;


class BasePage
{
    /**
     * @var AcceptanceTester
     */
    protected $tester;

    const SHOW_NAME = 'Free the Geek.fm with Matthew Setter.';
    const STRAPLINE = 'The podcast about building a rewarding career as a professional software developer and technical writer.';

    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I;
    }
}
