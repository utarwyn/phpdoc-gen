<?php

namespace Utarwyn\PhpdocGen;

use Symfony\Component\Yaml\Yaml;

class Config {

    public $source = 'src';

    public $transformer = 'github';

    public function __construct(string $filename = null)
    {
        if (!is_null($filename) && file_exists($filename)) {
            $contents = file_get_contents($filename);
            $yaml = Yaml::parse($contents);
            $this->loadYaml($yaml);
        }
    }

    private function loadYaml($yaml)
    {
        var_dump($yaml);
    }

}