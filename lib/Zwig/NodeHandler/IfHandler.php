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
use Zwig\Exception\NotImplementedException;
use Zwig\Exception\UnknownStructureException;
use Zwig\Sequence\Command;


/**
 * Compiles a node that represents a test.
 * @see http://twig.sensiolabs.org/doc/tags/if.html
 */
class IfHandler extends AbstractHandler
{
    const TWIG_NODE_CLASS_NAME = 'Twig_Node_If';

    /**
     * @param Twig_Node $node
     * @return Command[]
     * @throws NotImplementedException
     * @throws UnknownStructureException
     */
    public function compile(Twig_Node $node)
    {

        $body = $this->getCompiledNode($node, 'tests');
        $else = $this->getOptionalCompiledNode($node, 'else');
        $test = array_shift($body);

        $commands = [];
        $commands[] = new Command("if ({$test}) {");
        $commands = array_merge($commands, $body);

        if ($else === null) {
            $commands[] = new Command('}');
        } else {
            $commands[] = new Command('} else {');
            $commands = array_merge($commands, $else);
            $commands[] = new Command('}');
        }

        return $commands;
    }
}