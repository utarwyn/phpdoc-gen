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
        $this->tree = ReaderUtil::getRecursiveFiles($sourceFolder);

        // TODO: a tiny test
        try {
            $class = new \ReflectionClass('Utarwyn\PhpdocGen\Reader\PhpDocReader');
            var_dump($class->getDocComment());
        } catch (\ReflectionException $e) {
            var_dump($e->getMessage());
        }
    }

}