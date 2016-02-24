<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('Ensure that the redirect to the iTunes page works');

$page = new \Page\iTunes($I);
$page->testHomePage();
