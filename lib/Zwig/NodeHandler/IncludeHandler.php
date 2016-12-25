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
use Zwig\Sequence\Command;
use Zwig\Sequence\Segment;


/**
 * Compiles a node that includes another template.
 * @see http://twig.sensiolabs.org/doc/tags/include.html
 */
class IncludeHandler extends AbstractHandler
{
    const TWIG_NODE_CLASS_NAME = 'Twig_Node_Include';

    /**
     * @param Compiler $compiler
     * @param Twig_Node $node
     * @return Command[]
     * @throws NotImplementedException
     * @throws UnknownStructureException
     */
    public function compile(Compiler $compiler, Twig_Node $node)
    {
        return [new Command('html += zwig.render(%s, %s, %s, %s);', [
            $this->getCompiledNode($compiler, $node, 'expr'),
            $this->getIncludeData($compiler, $node),
            $this->getIncludeContext($node),
            $this->getOptionIgnoreMissing($node)
        ])];
    }

    /**
     * @param Compiler $compiler
     * @param Twig_Node $node
     * @return Segment|string
     */
    private function getIncludeData(Compiler $compiler, Twig_Node $node)
    {
        if ($node->hasNode('variables') && $child = $node->getNode('variables')) {
            return $compiler->compileNode($child);
        }

        return '[]';
    }

    /**
     * @param Twig_Node $node
     * @return string
     */
    private function getIncludeContext(Twig_Node $node)
    {
        return $node->getAttribute('only') ? 'undefined' : 'context';
    }

    /**
     * @param Twig_Node $node
     * @return int
     */
    private function getOptionIgnoreMissing(Twig_Node $node)
    {
        return $node->getAttribute('ignore_missing') ? 1 : 0;
    }
}