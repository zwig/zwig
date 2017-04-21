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
use Zwig\Sequence\OutputCommand;


/**
 * Compiles a node that prints the value of an expression.
 */
class PrintHandler extends AbstractHandler
{
    const TWIG_NODE_CLASS_NAME = 'Twig_Node_Print';

    /**
     * @param Compiler $compiler
     * @param Twig_Node $node
     * @return OutputCommand[]
     * @throws NotImplementedException
     * @throws UnknownStructureException
     */
    public function compile(Compiler $compiler, Twig_Node $node)
    {
        return [new OutputCommand('html += %s;', [
            $this->getCompiledNode($compiler, $node, 'expr')
        ])];
    }
}