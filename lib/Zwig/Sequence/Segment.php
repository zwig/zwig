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

namespace Zwig\Sequence;


/**
 * Represent a part of a JavaScript command.
 */
class Segment
{
    protected $format;
    protected $segments;
    protected $isAutonomous = false;
    protected $isCombinable = false;


    /**
     * Segment constructor.
     * @param string $format
     * @param array $segments
     */
    public function __construct($format, array $segments = [])
    {
        $this->format = $format;
        $this->segments = $segments;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return vsprintf($this->format, $this->segments);
    }

    /**
     * Tries to combine two commands.
     * Returns true if succeeded.
     * @param Segment $segment
     * @return bool
     */
    public function combine(Segment $segment)
    {
        if (!$this->areSegmentsCombinable($this, $segment)) {
            return false;
        }

        $this->segments = array_merge($this->segments, $segment->getSegments());

        return true;
    }

    /**
     * @return array
     */
    public function getSegments()
    {
        return $this->segments;
    }

    /**
     * @param Segment $segment1
     * @param Segment $segment2
     * @return bool
     */
    private function areSegmentsCombinable(Segment $segment1, Segment $segment2)
    {
        if (get_class($segment1) !== get_class($segment2)) {
            return false;
        }

        if (!$segment1->isCombinable || !$segment2->isCombinable) {
            return false;
        }

        return true;
    }
}