<?php
$template = 'OperatorFloorDiv.twig';
$includes = [];

$I = new AcceptanceTester($scenario);
$I->wantTo('See if the operator `floor div` work as expected');

\PHPUnit_Framework_Assert::assertEquals(
    $I->wantTwigSource($template),
    $I->wantZwigSource($template, $includes)
);