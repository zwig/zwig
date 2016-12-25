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

namespace Zwig\Tool;

use Twig_Environment;
use Twig_Loader_Filesystem;
use Zwig\Exception\InvalidParameterException;
use Zwig\Zwig;


class DisplayTool
{
    public function run(array $arguments)
    {
        $templateName = $this->getRequiredParameter($arguments, 'template');
        $outputType = $this->getRequiredParameter($arguments, 'type');
        $includeNames = $this->getOptionalParameter($arguments, 'includes');

        $dataPath = sprintf('%s/tests/_data', dirname(dirname(dirname(dirname(__FILE__)))));
        $contextPath = sprintf('%s/%s.json', $dataPath, basename($templateName, '.twig'));

        $twigLoader = new Twig_Loader_Filesystem($dataPath);
        $twig = new Twig_Environment($twigLoader);

        $context = $this->getContext($contextPath);

        $html = $outputType == 'twig' ?
            $this->displayTwig($twig, $templateName, $context) :
            $this->displayZwig($twig, $templateName, $context, $includeNames);

        echo $html;
    }

    /**
     * @param array $arguments
     * @param string $name
     * @return string
     */
    private function getRequiredParameter(array $arguments, $name)
    {
        if (!isset($arguments[$name])) {
            throw new InvalidParameterException(sprintf('Parameter `%s` not set!', $name));
        }

        return $arguments[$name];
    }

    /**
     * @param array $arguments
     * @param string $name
     * @return string
     */
    private function getOptionalParameter(array $arguments, $name)
    {
        if (!isset($arguments[$name])) {
            return false;
        }

        return $arguments[$name];
    }

    /**
     * @param string $path
     * @return array
     */
    private function getContext($path)
    {
        if (!is_file($path)) {
            return [];
        }

        try {
            $context = json_decode(mb_convert_encoding(file_get_contents($path), 'UTF-8'), true);
        } catch (\Exception $ex) {
            return [];
        }

        if ($context === null) {
            return [];
        }

        return $context;
    }

    /**
     * @param Twig_Environment $twig
     * @param string $templateName
     * @param array $context
     */
    private function displayTwig(Twig_Environment $twig, $templateName, $context)
    {
        $template = $twig->loadTemplate($templateName);
        return $template->display($context);
    }

    /**
     * @param Twig_Environment $twig
     * @param string $templateName
     * @param array $context
     * @param string $includeNames
     * @return string
     */
    private function displayZwig(Twig_Environment $twig, $templateName, $context, $includeNames)
    {
        $zwig = new Zwig($twig);
        $source = $zwig->convertFile($templateName);
        $json = json_encode($context);

        if ($includeNames) {
            foreach (explode(',', $includeNames) as $name) {
                $source .= $zwig->convertFile($name);
            }
        }

        $html = "<html>"
            . "  <head>"
            . "    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />"
            . "    <script src='/dist/zwig.js'></script>"
            . "    <script>${source}</script>"
            . "    <script>"
            . "      document.write(Zwig.render('{$templateName}', ${json}));"
            . "    </script>"
            . "  </head>"
            . "  <body></body>"
            . "</html>";

        return $html;
    }
}
