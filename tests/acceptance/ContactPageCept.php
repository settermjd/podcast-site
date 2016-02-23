<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that contact page works');
$I->amOnPage('/contact');
$I->seeInTitle('Free the Geek.fm with Matthew Setter - The podcast about the business of freelancing as a software developer, writer, content producer, and all round PHP lover');

// Test the links
$I->seeLink("About", "/about");
$I->seeLink("Contact", "/contact");

$I->see("Got Questions");
$I->see("If you want to get in touch with me, whether it's feedback about the show, the site, or something completely different, I'm available via the following options");
