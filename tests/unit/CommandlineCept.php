<?php
use Zwig\Action\ConvertCommand;

class CommandlineCept extends \PHPUnit_Framework_TestCase
{
    public function testReadDirectoryAllPathsAbsolute()
    {
        $action = new ConvertCommand();
        $this->invoke($action, 'readDirectory', [[
            'tests/_data/unit/'
        ]]);
    }

    /**
     * @param object $object
     * @param string $methodName
     * @param array $parameters
     * @return mixed
     */
    public function invoke(&$object, $methodName, array $parameters = [])
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}