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
     * @param Twig_Node $node
     * @return Segment
     * @throws NotImplementedException
     * @throws UnknownStructureException
     */
    public function compile(Twig_Node $node)
    {
        return new Segment('filters[%s](%s)', [
            $this->getCompiledNode($node, 'filter'),
            $this->getFilterSignature($node)
        ]);
    }

    /**
     * @param Twig_Node $node
     * @return string
     * @throws NotImplementedException
     * @throws UnknownStructureException
     */
    private function getFilterSignature(Twig_Node $node)
    {
        $arguments = $this->getFilterArguments($node);
        if (!$arguments) {
            return $this->getCompiledNode($node, 'node');
        }

        return sprintf('%s, %s', $this->getCompiledNode($node, 'node'), implode(',', $arguments));
    }

    /**
     * @param Twig_Node $node
     * @return Segment[]
     * @throws NotImplementedException
     * @throws UnknownStructureException
     */
    private function getFilterArguments(Twig_Node $node)
    {
        if (!$node->hasNode('arguments')) {
            return [];
        }

        $arguments = [];
        foreach ($node->getNode('arguments') as $argument) {
            $arguments[] = Compiler::compileNode($argument);
        }

        return $arguments;
    }
}