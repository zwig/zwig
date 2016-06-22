<?php
$template = 'TagSet.twig';
$includes = [];

$I = new AcceptanceTester($scenario);
$I->wantTo('See if the tag `set` works as expected');

\PHPUnit_Framework_Assert::assertEquals(
    $I->wantTwigSource($template),
    $I->wantZwigSource($template, $includes)
);