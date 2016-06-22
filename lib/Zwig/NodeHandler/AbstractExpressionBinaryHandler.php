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
use Zwig\Exception\NotImplementedException;
use Zwig\Exception\UnknownStructureException;
use Zwig\Sequence\Segment;


/**
 * Compiles a node that handles two nodes.
 */
abstract class AbstractExpressionBinaryHandler extends AbstractHandler
{
    /**
     * @param Twig_Node $node
     * @param string $operation
     * @return Segment
     * @throws NotImplementedException
     * @throws UnknownStructureException
     */
    protected function compileBinary(Twig_Node $node, $operation)
    {
        return new Segment('%s %s %s', [
            $this->getCompiledNode($node, 'left'),
            $operation,
            $this->getCompiledNode($node, 'right'),
        ]);
    }
}