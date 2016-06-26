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
 * Compiles every child of a plain node.
 */
class NodeHandler extends AbstractHandler
{
    const TWIG_NODE_CLASS_NAME = 'Twig_Node';

    /**
     * @param Compiler $compiler
     * @param Twig_Node $node
     * @return Segment[]
     * @throws NotImplementedException
     * @throws UnknownStructureException
     */
    public function compile(Compiler $compiler, Twig_Node $node)
    {
        $commands = [];
        foreach ($node as $child) {
            $compilation = $compiler->compileNode($child);

            if (is_array($compilation)) {
                $commands = array_merge($commands, $compilation);
            } else {
                $commands[] = $compilation;
            }
        }

        return $commands;
    }
}