<?php
$template = 'OperatorStartsWith.twig';
$includes = [];

$I = new AcceptanceTester($scenario);
$I->wantTo('See if the operator `starts with` work as expected');

\PHPUnit_Framework_Assert::assertEquals(
    $I->wantTwigSource($template),
    $I->wantZwigSource($template, $includes)
);