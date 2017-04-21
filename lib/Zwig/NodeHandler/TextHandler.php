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
use Zwig\Sequence\OutputCommand;


/**
 * Compiles a node that prints some static text.
 */
class TextHandler extends AbstractHandler
{
    const TWIG_NODE_CLASS_NAME = 'Twig_Node_Text';

    /**
     * @param Compiler $compiler
     * @param Twig_Node $node
     * @return OutputCommand[]
     */
    public function compile(Compiler $compiler, Twig_Node $node)
    {
        $text = sprintf('"%s"', str_replace("\n", '\n', addslashes($node->getAttribute('data'))));
        return [new OutputCommand('html += %s;', [$text])];
    }
}