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
use Zwig\Sequence\Command;


/**
 * Compiles a node that is used by Twig for an iteration.
 */
class ForLoopHandler extends AbstractHandler
{
    const TWIG_NODE_CLASS_NAME = 'Twig_Node_ForLoop';

    /**
     * @param Compiler $compiler
     * @param Twig_Node $node
     * @return Command[]
     */
    public function compile(Compiler $compiler, Twig_Node $node)
    {
        return [];
    }
}