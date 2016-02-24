<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that contact page works');

$page = new \Page\Contact($I);
$page->testContactPage();
