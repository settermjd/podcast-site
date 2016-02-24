<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that frontpage works');

$page = new \Page\Home($I);

$page->testHomePage();
