<?php
$template = 'TestDefined.twig';
$includes = [];

$I = new AcceptanceTester($scenario);
$I->wantTo('See if the test `defined` works as expected');

\PHPUnit_Framework_Assert::assertEquals(
    $I->wantTwigSource($template),
    $I->wantZwigSource($template, $includes)
);