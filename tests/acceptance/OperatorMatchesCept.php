<?php
$template = 'OperatorMatches.twig';
$includes = [];

$I = new AcceptanceTester($scenario);
$I->wantTo('See if the operator `matches` work as expected');

\PHPUnit_Framework_Assert::assertEquals(
    $I->wantTwigSource($template),
    $I->wantZwigSource($template, $includes)
);