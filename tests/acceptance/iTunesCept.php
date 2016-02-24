<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('Ensure that the redirect to the iTunes page works');
$I->amOnPage('/itunes');
$I->seeInCurrentUrl('/podcast/free-geek.fm-matthew-setter/id1018923368?l=en&mt=2');
