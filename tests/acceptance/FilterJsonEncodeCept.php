<?php
$template = 'FilterJsonEncode.twig';
$includes = [];

$I = new AcceptanceTester($scenario);
$I->wantTo('See if the filter `json_encode` works as expected');

\PHPUnit_Framework_Assert::assertEquals(
    $I->wantTwigSource($template),
    $I->wantZwigSource($template, $includes)
);