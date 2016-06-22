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
 * Compiles a node that defines an array.
 * @see http://twig.sensiolabs.org/doc/templates.html#twig-expressions
 */
class ExpressionArrayHandler extends AbstractHandler
{
    const TWIG_NODE_CLASS_NAME = 'Twig_Node_Expression_Array';

    /**
     * @param Twig_Node $node
     * @return Segment
     * @internal param Template $template
     * @throws NotImplementedException
     * @throws UnknownStructureException
     */
    public function compile(Twig_Node $node)
    {
        if ($node->count() % 2 !== 0) {
            throw new UnknownStructureException(
                sprintf('Unknown structure for `%s` at line %s', __CLASS__, $node->getLine())
            );
        }

        $values = $this->getValues($node);

        return $this->arrayIsList($values) ?
            $this->formatList($values) :
            $this->formatDict($values);
    }

    /**
     * @param Twig_Node $node
     * @return array
     */
    private function getValues(Twig_Node $node)
    {
        $values = [];

        for ($i = 0; $i < $node->count(); $i += 2) {
            $key = Compiler::compileNode($node->getNode($i));
            $value = Compiler::compileNode($node->getNode($i + 1));
            $values[strval($key)] = strval($value);
        }

        return $values;
    }

    /**
     * @param array $values
     * @return bool
     */
    private function arrayIsList(array $values)
    {
        $index = 0;
        foreach ($values as $key => $value) {
            if ($key !== $index++) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param array $values
     * @return Segment[]
     */
    private function formatList(array $values)
    {
        return new Segment('[%s]', [
            implode(', ', array_values($values))
        ]);
    }

    /**
     * @param array $values
     * @return Segment[]
     */
    private function formatDict(array $values)
    {
        foreach ($values as $key => $value) {
            $values[$key] = sprintf('%s: %s', $key, $value);
        }

        return new Segment('{%s}', [
            implode(', ', array_values($values))
        ]);
    }
}