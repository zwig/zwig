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

use Zwig\Util\UniqueID;


/**
 * Register a compiled template within the global Zwig namespace.
 */
class GlobalExport implements ExportInterface
{
    /**
     * @param string $filename
     * @param string $code
     * @return string
     */
    public function export($filename, $code)
    {
        $script = "Zwig.Templates.%s = function(context) {\n"
            . "  return (function(zwig, operators, filters, context) {\n"
            . "    var html = '';\n"
            . "    %s\n"
            . "    return html;\n"
            . "  })(Zwig, Zwig.Operators, Zwig.Filters, context);\n"
            . "};";

        return sprintf($script, (new UniqueID())->fromFunctionName($filename), $code);
    }
}