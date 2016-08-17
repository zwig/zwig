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

namespace Zwig\Sequence;


/**
 * Represent a part of a JavaScript command.
 */
class ConstantSegment extends Segment
{
    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->format;
    }
}