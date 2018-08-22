<?php

namespace Utarwyn\PhpdocGen;

use Symfony\Component\Yaml\Yaml;

class Config {

    public $source = 'src';

    public $transformer = 'github';

    public function __construct(string $filename = null)
    {
        if (!is_null($filename) && file_exists($filename)) {
            $yaml = Yaml::parseFile($filename);

            if (!is_null($yaml)) {
                $this->loadYaml($yaml);
            }
        }
    }

    private function loadYaml($yaml)
    {
        foreach(get_object_vars($this) as $property => $value) {
            if (isset($yaml[$property])) {
                $this->$property = $yaml[$property];
            }
        }
    }

}