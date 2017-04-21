<?php
/*
 * This file is part of Zwig.
 *
 * (c) Alexander Kramer
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
use Zwig\Sequence\Segment;


/**
 * Compiles a node that checks if a variable is divisible without a rest.
 * @see http://twig.sensiolabs.org/doc/tests/divisibleby.html
 */
class ExpressionTestDivisiblebyHandler extends AbstractHandler
{
    const TWIG_NODE_CLASS_NAME = 'Twig_Node_Expression_Test_Divisibleby';

    /**
     * @param Compiler $compiler
     * @param Twig_Node $node
     * @return string
     * @throws NotImplementedException
     * @throws UnknownStructureException
     */
    public function compile(Compiler $compiler, Twig_Node $node)
    {
        return new Segment('((%s %% %s) == 0 ? 1 : 0)', [
            $this->getCompiledNode($compiler, $node, 'node'),
            array_pop($this->getCompiledNode($compiler, $node, 'arguments'))
        ]);
    }
}