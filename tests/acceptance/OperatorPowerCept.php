<?php
$template = 'OperatorPower.twig';
$includes = [];

$I = new AcceptanceTester($scenario);
$I->wantTo('See if the operator `power` work as expected');

\PHPUnit_Framework_Assert::assertEquals(
    $I->wantTwigSource($template),
    $I->wantZwigSource($template, $includes)
);