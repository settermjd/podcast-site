<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('Ensure that the redirect to the iTunes page works');
$I->amOnPage('/itunes');
$I->wait(2);
$I->seeResponseCodeIs(302);
$I->seeHttpHeader('Location', 'https://itunes.apple.com/podcast/free-geek.fm-matthew-setter/id1018923368?l=en&mt=2');
