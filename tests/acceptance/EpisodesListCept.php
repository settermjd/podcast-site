<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the episodes listing works');
$I->amOnPage('/episodes');
$I->seeInTitle('Free The Geek.fm - The podcast about the business of freelancing as a software developer, writer, content producer, and all round PHP lover.');
$I->see("Episodes", "//h2[@class='section-heading']");

