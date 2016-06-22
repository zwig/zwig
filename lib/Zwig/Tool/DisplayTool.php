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

        if ($outputType == 'twig') {
            $this->displayTwig($twig, $templateName, $context);
        } else {
            $this->displayZwig($twig, $templateName, $context, $includeNames);
        }
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
        try {
            $context = json_decode(file_get_contents($path), true);
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
        $template->display($context);
    }

    /**
     * @param Twig_Environment $twig
     * @param string $templateName
     * @param array $context
     * @param string $includeNames
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
            . "    <script src='/dist/zwig.js'></script>"
            . "    <script>{$source}</script>"
            . "    <script>"
            . "      document.write(Zwig.render('{$templateName}', {$json}));"
            . "    </script>"
            . "  </head>"
            . "  <body></body>"
            . "</html>";

        echo $html;
    }
}
