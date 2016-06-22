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
 * Represent a JavaScript command.
 */
class OutputCommand extends Segment
{
    protected $isCombinable = true;

    public function __toString()
    {
        return vsprintf($this->format, implode(' + ', $this->segments));
    }
}