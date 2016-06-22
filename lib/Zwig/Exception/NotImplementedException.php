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

namespace Zwig\Exception;


/**
 * Will be thrown when a template uses a feature that is not implemented by Zwig.
 */
class NotImplementedException extends \InvalidArgumentException
{
}