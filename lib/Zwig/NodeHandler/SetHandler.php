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
 * Compiles a node that sets the value of a variable.
 * @see http://twig.sensiolabs.org/doc/tags/set.html
 */
class SetHandler extends AbstractHandler
{
    const TWIG_NODE_CLASS_NAME = 'Twig_Node_Set';

    /**
     * @param Twig_Node $node
     * @return Command[]
     * @throws NotImplementedException
     * @throws UnknownStructureException
     */
    public function compile(Twig_Node $node)
    {
        $names = $this->getCompiledNode($node, 'names');
        $values = $this->getCompiledNode($node, 'values');

        $commands = [];
        for ($i = 0; $i < count($names) && $i < count($values); $i++) {
            $commands[] = new Command('context.set("%s", %s);', [
                $names[$i],
                $values[$i]
            ]);
        }

        return $commands;
    }
}