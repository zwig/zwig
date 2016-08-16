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
use Zwig\Sequence\Segment;


/**
 * Compiles a node that represents a filter call.
 * @see http://twig.sensiolabs.org/doc/filters/index.html
 */
class ExpressionFilterHandler extends AbstractHandler
{
    const TWIG_NODE_CLASS_NAME = 'Twig_Node_Expression_Filter';

    /**
     * @param Compiler $compiler
     * @param Twig_Node $node
     * @return Segment
     * @throws NotImplementedException
     * @throws UnknownStructureException
     */
    public function compile(Compiler $compiler, Twig_Node $node)
    {
        return new Segment('filters[%s](%s)', [
            $this->getCompiledNode($compiler, $node, 'filter'),
            $this->getFilterSignature($compiler, $node)
        ]);
    }

    /**
     * @param Compiler $compiler
     * @param Twig_Node $node
     * @return string
     * @throws NotImplementedException
     * @throws UnknownStructureException
     */
    private function getFilterSignature(Compiler $compiler, Twig_Node $node)
    {
        $arguments = $this->getFilterArguments($compiler, $node);
        if (!$arguments) {
            return sprintf('context, %s', $this->getCompiledNode($compiler, $node, 'node'));
        }

        return sprintf('context, %s, %s', $this->getCompiledNode($compiler, $node, 'node'), implode(',', $arguments));
    }

    /**
     * @param Compiler $compiler
     * @param Twig_Node $node
     * @return Segment[]
     * @throws NotImplementedException
     * @throws UnknownStructureException
     */
    private function getFilterArguments(Compiler $compiler, Twig_Node $node)
    {
        if (!$node->hasNode('arguments')) {
            return [];
        }

        $arguments = [];
        foreach ($node->getNode('arguments') as $argument) {
            $arguments[] = $compiler->compileNode($argument);
        }

        return $arguments;
    }
}