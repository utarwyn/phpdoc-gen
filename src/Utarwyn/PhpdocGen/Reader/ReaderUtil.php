<?php

namespace Utarwyn\PhpdocGen\Reader;

class ReaderUtil
{

    private function __construct()
    {

    }

    public static function getRecursiveFiles(string $directory)
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