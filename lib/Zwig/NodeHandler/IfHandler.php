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
        $tests = $node->getNode('tests');
        $else = $this->getOptionalCompiledNode($compiler, $node, 'else');

        $commands = $this->getIfCommands($compiler, $tests);

        if ($else !== null) {
            $commands = array_merge($commands, $this->getElseCommands($else));
        }

        return $commands;
    }

    /**
     * @param Compiler $compiler
     * @param Twig_Node $body
     * @return array
     */
    private function getIfCommands(Compiler $compiler, Twig_Node $body)
    {
        $test = $compiler->compileNode($body->getNode(0));
        $cmd = $compiler->compileNode($body->getNode(1));

        $commands = [];
        $commands[] = new Command("if ($test) {");
        $commands = array_merge($commands, $cmd);
        $commands[] = new Command('}');

        for ($i = 2; $i < count($body); $i += 2) {
            $test = $compiler->compileNode($body->getNode($i + 0));
            $cmd = $compiler->compileNode($body->getNode($i + 1));

            $commands[] = new Command("else if ($test) {");
            $commands = array_merge($commands, $cmd);
            $commands[] = new Command('}');
        }

        return $commands;
    }

    /**
     * @param array $else
     * @return array
     */
    private function getElseCommands(array $else)
    {
        $commands = [];
        $commands[] = new Command('else {');
        $commands = array_merge($commands, $else);
        $commands[] = new Command('}');

        return $commands;
    }
}