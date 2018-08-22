<?php

namespace Utarwyn\PhpdocGen\Reader;

/**
 * Class PhpDocReader
 * @package Utarwyn\PhpdocGen\Reader
 */
class PhpDocReader
{

    private $sourceFolder;

    private $tree;

    public function __construct(string $sourceFolder)
    {
        $this->sourceFolder = $sourceFolder;
        $this->tree = $this->readFiles($sourceFolder);

        foreach ($this->tree as $file) {
            $wrapper = new FileWrapper($file);

            $begin = microtime(true);
            $wrapper->analyse();
            echo(PHP_EOL . $file . ': ' . round((microtime(true) - $begin)*1000, 3) . 'ms' . PHP_EOL);
        }
    }

    public function readFiles(string $directory)
    {
        $directory = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($directory));
        $files = array();

        foreach ($directory as $filename => $fileObject) {
            if (substr($filename, -4) === '.php') {
                array_push($files, $filename);
            }
        }

        return $files;
    }

}