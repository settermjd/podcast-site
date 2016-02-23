<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('Ensure that the RSS Feed works');
$I->amOnPage('/rss');
$I->see("http://freethegeek.fm/episode/episode-0001", "//rss/channel/item/link");
$I->amOnPage('/rss.xml');
