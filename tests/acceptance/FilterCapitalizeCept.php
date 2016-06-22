<?php
$template = 'FilterCapitalize.twig';
$includes = [];

$I = new AcceptanceTester($scenario);
$I->wantTo('See if the filter `capitalize` works as expected');

\PHPUnit_Framework_Assert::assertEquals(
    $I->wantTwigSource($template),
    $I->wantZwigSource($template, $includes)
);