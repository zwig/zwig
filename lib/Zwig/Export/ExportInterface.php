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

namespace Zwig\Export;


/**
 * After the compiler translated a Twig template into JavaScript,
 * the resulting function has to be made accessible by an exporter.
 */
interface ExportInterface
{
    /**
     * @param string $filename
     * @param string $code
     * @return string
     */
    public function export($filename, $code);
}