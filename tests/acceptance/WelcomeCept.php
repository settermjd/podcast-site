<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that frontpage works');
$I->amOnPage('/');
$I->seeInTitle('Free The Geek.fm - The podcast about the business of freelancing as a software developer, writer, content producer, and all round PHP lover.');

// Test the "about" section
$I->see("What's It About?");
$I->see("It's a fireside chat on the ins and outs of being a freelance writer, screencaster, teacher, and software developer. Looking at what it’s like to do it, warts and all, as well as how to get started, what to expect, the good, the bad, and the ugly. When we’re not talking that, we’re talking tech, code, apps, development, and of course PHP.");

// Test the subscribe buttons
$I->seeLink("Subscribe via RSS", "/rss.xml");
$I->seeLink("Subscribe on iTunes!", "https://itunes.apple.com/de/podcast/free-geek.fm-matthew-setter/id1018923368?l=en&mt=2");

// Test the "contact" section
$I->see('Got Questions');
$I->see("If you want to get in touch with me you'll, find all the contact details you need below");
$I->see("settermjd (skype)");
$I->see("matthew@freethegeek.fm");
$I->seeLink("Matthew Setter", "http://www.matthewsetter.com");
$I->seeLink("the Slim Framework", "http://slimframework.com");

// Test the links
$I->seeLink("Free The Geek.fm", "/");
$I->seeLink("About", "/#about");
$I->seeLink("Contact", "/#contact");
$I->seeLink("Episodes", "/episodes");

// Test that the episodes appear on the home page
$I->see("Episodes", "//h2[@class='section-heading']");
$I->see("13.07.2015 / Episode 1", "//h3/a");

