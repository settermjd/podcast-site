<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('Ensure that the RSS Feed works');
$I->amOnPage('/rss');
$I->amOnPage('/rss.xml');
