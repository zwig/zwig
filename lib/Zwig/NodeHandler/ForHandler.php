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
use Zwig\Util\UniqueID;


/**
 * Compiles a node that represents a iteration.
 * @see http://twig.sensiolabs.org/doc/tags/for.html
 */
class ForHandler extends AbstractHandler
{
    const TWIG_NODE_CLASS_NAME = 'Twig_Node_For';

    /**
     * @param Compiler $compiler
     * @param Twig_Node $node
     * @return Command[]
     * @throws NotImplementedException
     * @throws UnknownStructureException
     */
    public function compile(Compiler $compiler, Twig_Node $node)
    {
        $uniqueID = new UniqueID();

        $counter = $uniqueID->withPrefix('counter');
        $sequence = $uniqueID->withPrefix('sequence');
        $source = $this->getCompiledNode($compiler, $node, 'seq');
        $target = $this->getCompiledNode($compiler, $node, 'value_target');
        $body = $this->getCompiledNode($compiler, $node, 'body');
        $else = $this->getOptionalCompiledNode($compiler, $node, 'else');

        $commands = [];
        $commands[] = new Command("var {$sequence} = {$source};");
        $commands[] = new Command("for (var {$counter} = 0; {$counter} < {$sequence}.length; {$counter}++) {");
        $commands[] = new Command("context.push();");
        $commands[] = new Command("context.set('{$target}', {$sequence}[{$counter}]);");
        $commands = array_merge($commands, $body);
        $commands[] = new Command("context.pop();");
        $commands[] = new Command("}");

        if ($else !== null) {
            $commands[] = new Command("if ({$sequence}.length == 0) {");
            $commands = array_merge($commands, $else);
            $commands[] = new Command("}");
        }

        return $commands;
    }
}