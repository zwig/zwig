<?php
$template = 'FilterEscape.twig';
$includes = [];

$I = new AcceptanceTester($scenario);
$I->wantTo('See if the filter `escape` works as expected');

\PHPUnit_Framework_Assert::assertEquals(
    $I->wantTwigSource($template),
    $I->wantZwigSource($template, $includes)
);