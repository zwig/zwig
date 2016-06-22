<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
 */
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

    public function wantTwigSource($template)
    {
        $this->amOnPage(sprintf('/tests/_bin/display.php?template=%s&type=twig', urlencode($template)));
        $this->seeInCurrentUrl('type=twig');
        return $this->wantTheSource();
    }

    public function wantZwigSource($template, $includes = [])
    {
        $this->amOnPage(sprintf('/tests/_bin/display.php?template=%s&type=zwig&includes=%s', urlencode($template), implode(',', $includes)));
        $this->seeInCurrentUrl('type=zwig');
        return $this->wantTheSource();
    }

    public function wantTheSource()
    {
        return trim($this->executeJS('return document.getElementsByTagName("body")[0].innerHTML'));
    }
}
