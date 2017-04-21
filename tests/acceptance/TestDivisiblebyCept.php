<?php
$template = 'TestDivisibleby.twig';
$includes = [];

$I = new AcceptanceTester($scenario);
$I->wantTo('See if the test `divisible by` works as expected');

\PHPUnit_Framework_Assert::assertEquals(
    $I->wantTwigSource($template),
    $I->wantZwigSource($template, $includes)
);