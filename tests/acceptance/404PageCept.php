<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that 404 page works');

$page = new \Page\NotFound($I);
$page->check404Page();
