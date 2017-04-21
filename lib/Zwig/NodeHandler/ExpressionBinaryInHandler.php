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
 * Compiles a node that checks if a value is within an array or string.
 * @see http://twig.sensiolabs.org/doc/templates.html#containment-operator
 */
class ExpressionBinaryInHandler extends AbstractHandler
{
    const TWIG_NODE_CLASS_NAME = 'Twig_Node_Expression_Binary_In';

    /**
     * @param Compiler $compiler
     * @param Twig_Node $node
     * @return Segment
     * @throws NotImplementedException
     * @throws UnknownStructureException
     */
    public function compile(Compiler $compiler, Twig_Node $node)
    {
        return new Segment('operators.in(%s, %s)', [
            $this->getCompiledNode($compiler, $node, 'left'),
            $this->getCompiledNode($compiler, $node, 'right')
        ]);
    }
}