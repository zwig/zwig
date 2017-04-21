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

namespace Zwig\Action;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Zwig\Zwig;

class ConvertCommand extends Command
{
    private $root;
    private $files = [];
    private $extensions = [];

    protected function configure()
    {
        $this->setName('convert');
        $this->setDescription('Convert Twig templates into JavaScript');

        $this->addArgument('input', InputArgument::REQUIRED, 'Template location or JSON file');
        $this->addOption(
            'extension', 'e',
            InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
            'Load a Twig extension'
        );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getParameters($input);

        $twigLoader = new \Twig_Loader_Filesystem($this->root);
        $twigEnvironment = new \Twig_Environment($twigLoader);

        foreach ($this->extensions as $extension) {
            $twigEnvironment->addExtension($extension);
        }

        $zwig = new Zwig($twigEnvironment);

        foreach ($this->files as $source => $destination) {
            try {
                file_put_contents($this->root . $destination, $zwig->convertFile($source));
                $output->writeln(sprintf('┏━  %s<info>%s</info>', $this->root, $source));
                $output->writeln(sprintf('┗━➤ %s<info>%s</info>', $this->root, $destination));
            } catch (\Exception $ex) {
                $output->writeln(sprintf('┏━  %s<error>%s</error>', $this->root, $source));
                $output->writeln(sprintf('┗━➤ %s<error>%s</error>', $this->root, $destination));
                throw $ex;
            }
        }
    }

    /**
     * @param InputInterface $input
     * @throws \Exception
     */
    private function getParameters(InputInterface $input)
    {
        $value = realpath($input->getArgument('input'));
        if (is_dir($value)) {
            $this->getParametersFromInput($input, $value);
        } elseif (is_file($value)) {
            $this->getParametersFromJSON($value);
        } else {
            throw new \InvalidArgumentException('Input not found');
        }
    }

    /**
     * @param InputInterface $input
     * @param string $root
     */
    private function getParametersFromInput(InputInterface $input, $root)
    {
        $this->root = $root;
        $this->files = $this->getFilesFromPath($root);
        $this->extensions = $this->getExtensionsFromInput($input);
    }

    private function getParametersFromJSON($root)
    {
        $json = $this->readJSON($root);
        $this->root = $this->getRootFromJSON($json);
        $this->files = $this->getFilesFromJSON($json);
        $this->extensions = $this->getExtensionFromJSON($json);
    }

    /**
     * @param $root
     */
    private function getFilesFromPath($root)
    {
        $directoryIterator = new \RecursiveDirectoryIterator($root);
        $recursiveIterator = new \RecursiveIteratorIterator($directoryIterator);
        $iterator = new \RegexIterator($recursiveIterator, '/.*\.twig/', \RegexIterator::GET_MATCH);

        $paths = [];
        foreach ($iterator as $path) {
            $paths = array_merge($paths, $path);
        }

        return $this->getFilesFromArray($paths);
    }

    /**
     * @param array $paths
     * @return array
     */
    private function getFilesFromArray(array $paths)
    {
        $files = [];
        foreach ($paths as $path) {
            $path = realpath($path);
            $source = $this->trimString($path, $this->root);
            $destination = $this->trimString($source, '.twig') . '.js';
            $files[$source] = $destination;
        }

        return $files;
    }

    /**
     * @param InputInterface $input
     * @return array
     */
    private function getExtensionsFromInput(InputInterface $input)
    {
        if (!$input->hasOption('extension')) {
            return [];
        }

        return $this->getExtensionsFromArray($input->getOption('extension'));
    }

    /**
     * @param array $extensions
     * @return array
     * @throws \InvalidArgumentException
     */
    private function getExtensionsFromArray(array $extensions)
    {
        foreach ($extensions as $index => $name) {
            if (!class_exists($name)) {
                throw new \InvalidArgumentException(sprintf('Unable to load extension %s', $name));
            }

            $extensions[$index] = new $name();
        }

        return $extensions;
    }

    /**
     * @param string $path
     * @throws \Exception
     */
    private function readJSON($path)
    {
        try {
            $data = json_decode(file_get_contents($path));
        } catch (\Exception $ex) {
            throw new \Exception('JSON: unable to parse file');
        }

        if (!isset($data->root)) {
            throw new \Exception('JSON: no root attribute');
        }

        if (!isset($data->files)) {
            throw new \Exception('JSON: no files attribute');
        }

        $this->root = realpath($data->root);
        $this->getFilesFromArray($data->files);

        if (isset($data->extensions)) {
            $this->getExtensionsFromArray($data->extensions);
        }
    }

    private function getRootFromJSON()
    {

    }

    /**
     * @param string $value
     * @param string $junk
     * @return string
     */
    private function trimString($value, $junk)
    {
        if (strpos($value, $junk) === 0) {
            $value = substr($value, strlen($junk));
        }

        if (strpos($value, $junk) == strlen($value) - strlen($junk)) {
            $value = substr($value, 0, strlen($value) - strlen($junk));
        }

        return $value;
    }
}