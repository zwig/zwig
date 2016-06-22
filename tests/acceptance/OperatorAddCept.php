<?php
$template = 'OperatorAdd.twig';
$includes = [];

$I = new AcceptanceTester($scenario);
$I->wantTo('See if the operator `add` work as expected');

\PHPUnit_Framework_Assert::assertEquals(
    $I->wantTwigSource($template),
    $I->wantZwigSource($template, $includes)
);