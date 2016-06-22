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

namespace Zwig;

use Twig_Environment;
use Zwig\Export\ExportInterface;
use Zwig\Export\GlobalExport;


/**
 * Compiles a Twig template into a full functional JavaScript function.
 */
class Zwig
{
    private $twigEnvironment;
    private $exportHandler;


    /**
     * Environment constructor.
     * @param Twig_Environment $twigEnvironment
     */
    public function __construct(Twig_Environment $twigEnvironment)
    {
        $this->twigEnvironment = $twigEnvironment;
        $this->exportHandler = new GlobalExport();
    }

    /**
     * @param string $filename
     * @param string $source
     * @return string
     */
    public function convertSource($filename, $source)
    {
        $compiler = new Compiler($this->twigEnvironment);
        $code = $compiler->compileSource($source);
        return $this->exportHandler->export($filename, $code);
    }

    /**
     * @param $filename
     * @return string
     */
    public function convertFile($filename)
    {
        $source = $this->twigEnvironment->getLoader()->getSource($filename);
        return $this->convertSource($filename, $source);
    }

    /**
     * @param ExportInterface $handler
     */
    public function setExportHandler(ExportInterface $handler)
    {
        $this->exportHandler = $handler;
    }
}