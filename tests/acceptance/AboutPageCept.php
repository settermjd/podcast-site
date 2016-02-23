<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that about page works');

$page = new \Page\About($I);
$page->checkAboutPage();
