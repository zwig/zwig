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
use Zwig\Sequence\Segment;


/**
 * Compiles a node that defines a variable read.
 */
class ExpressionNameHandler extends AbstractHandler
{
    const TWIG_NODE_CLASS_NAME = 'Twig_Node_Expression_Name';

    /**
     * @param Compiler $compiler
     * @param Twig_Node $node
     * @return Segment
     */
    public function compile(Compiler $compiler, Twig_Node $node)
    {
        return new Segment('context.get("%s")', [
            $node->getAttribute('name')
        ]);
    }
}