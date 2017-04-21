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


/**
 * Compiles every child of a body node.
 */
class BodyHandler extends NodeHandler
{
    const TWIG_NODE_CLASS_NAME = 'Twig_Node_Body';
}