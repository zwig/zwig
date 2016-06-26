<?php
/*
 * This file is part of Zwig.
 *
 * (c) Alexander Skrotzky
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed
 * with this source code.
 */

namespace Zwig\NodeHandler;

use Twig_Node;
use Zwig\Compiler;
use Zwig\Exception\NotImplementedException;
use Zwig\Exception\UnknownStructureException;
use Zwig\Sequence\Command;
use Zwig\Sequence\Segment;


/**
 * Compiles a node that represents a test.
 * @see http://twig.sensiolabs.org/doc/tags/if.html
 */
class IfHandler extends AbstractHandler
{
    const TWIG_NODE_CLASS_NAME = 'Twig_Node_If';

    /**
     * @param Compiler $compiler
     * @param Twig_Node $node
     * @return Command[]
     * @throws NotImplementedException
     * @throws UnknownStructureException
     */
    public function compile(Compiler $compiler, Twig_Node $node)
    {
        $body = $this->getCompiledNode($compiler, $node, 'tests');
        $else = $this->getOptionalCompiledNode($compiler, $node, 'else');
        $test = array_shift($body);

        if ($else !== null) {
            return $this->getIfElseCommands($test, $body, $else);
        }

        return $this->getIfCommands($test, $body);
    }

    /**
     * @param Segment $test
     * @param array $body
     * @return array
     */
    private function getIfCommands(Segment $test, array $body)
    {
        $commands = [];
        $commands[] = new Command("if ({$test}) {");
        $commands = array_merge($commands, $body);
        $commands[] = new Command('}');

        return $commands;
    }

    /**
     * @param Segment $test
     * @param array $body
     * @param array $else
     * @return array
     */
    private function getIfElseCommands(Segment $test, array $body, array $else)
    {
        $commands = [];
        $commands[] = new Command("if ({$test}) {");
        $commands = array_merge($commands, $body);
        $commands[] = new Command('} else {');
        $commands = array_merge($commands, $else);
        $commands[] = new Command('}');

        return $commands;
    }
}