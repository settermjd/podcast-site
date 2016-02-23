<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that about page works');
$I->amOnPage('/');
$I->seeInTitle('Free the Geek.fm with Matthew Setter - The podcast about the business of freelancing as a software developer, writer, content producer, and all round PHP lover');

// Test the links
$I->seeLink("About", "/about");
$I->seeLink("Contact", "/contact");

$I->see("In a Nutshell");
$I->see("Why Did I Launch It?");
$I->see("Here's What You Get");
$I->see("My Promise To You");
