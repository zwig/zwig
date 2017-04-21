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
 * Abstract class for a node compiler.
 */
abstract class AbstractHandler
{
    /**
     * @param Compiler $compiler
     * @param Twig_Node $node
     * @return Segment|Command[]
     * @throws NotImplementedException
     * @throws UnknownStructureException
     */
    public abstract function compile(Compiler $compiler, Twig_Node $node);

    /**
     * @param Compiler $compiler
     * @param Twig_Node $node
     * @param string $name
     * @return Command[]|Segment
     * @throws NotImplementedException
     * @throws UnknownStructureException
     */
    protected function getCompiledNode(Compiler $compiler, Twig_Node $node, $name)
    {
        if ($child = $node->getNode($name)) {
            return $compiler->compileNode($child);
        }

        throw new UnknownStructureException(
            sprintf('Unknown structure for `%s` at line %s', __CLASS__, $node->getTemplateLine())
        );
    }

    /**
     * @param Compiler $compiler
     * @param Twig_Node $node
     * @param string $name
     * @return null|Segment|Segment[]
     * @throws NotImplementedException
     * @throws UnknownStructureException
     */
    protected function getOptionalCompiledNode(Compiler $compiler, Twig_Node $node, $name)
    {
        if ($node->hasNode($name) && ($child = $node->getNode($name)) !== null) {
            return $compiler->compileNode($child);
        }

        return null;
    }

    /**
     * @param string $argument
     * @return string
     */
    protected function convertArgument($argument)
    {
        if (is_null($argument)) {
            return 'null';
        } else if (is_bool($argument)) {
            return $argument ? 'true' : 'false';
        } else if (is_int($argument)) {
            return $argument;
        } else if (is_float($argument)) {
            return $argument;
        }

        return sprintf("'%s'", str_replace("\n", '\n', addslashes($argument)));
    }

    /**
     * @param array $arguments
     * @return array
     */
    protected function convertArguments(array $arguments)
    {
        foreach ($arguments as $key => $argument) {
            $arguments[$key] = self::convertArgument($argument);
        }

        return $arguments;
    }
}