<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the episodes listing works');
$I->amOnPage('/episodes');
$I->seeInTitle('Free The Geek.fm - The podcast about the business of freelancing as a software developer, writer, content producer, and all round PHP lover.');
$I->see("Episodes", "//h2[@class='section-heading']");

// Test the subscribe buttons
$I->seeLink("Subscribe via RSS", "/rss.xml");
$I->seeLink("Subscribe on iTunes!", "https://itunes.apple.com/de/podcast/free-geek.fm-matthew-setter/id1018923368?l=en&mt=2");

