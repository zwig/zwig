<?php
$template = 'OperatorMod.twig';
$includes = [];

$I = new AcceptanceTester($scenario);
$I->wantTo('See if the operator `mod` work as expected');

\PHPUnit_Framework_Assert::assertEquals(
    $I->wantTwigSource($template),
    $I->wantZwigSource($template, $includes)
);