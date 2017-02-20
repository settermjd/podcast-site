<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the "for guests" page works');

$page = new \Page\ForGuests($I);
$page->checkForGuestsPage();
