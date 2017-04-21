<?php
$template = 'FilterBatch.twig';
$includes = [];

$I = new AcceptanceTester($scenario);
$I->wantTo('See if the filter `batch` works as expected');

\PHPUnit_Framework_Assert::assertEquals(
    $I->wantTwigSource($template),
    $I->wantZwigSource($template, $includes)
);