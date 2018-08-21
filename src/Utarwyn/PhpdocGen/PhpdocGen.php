<?php

namespace Utarwyn\PhpdocGen;

use Utarwyn\PhpdocGen\Reader\PhpDocReader;

class PhpdocGen
{

    private $config;

    private $reader;

    public function __construct()
    {
        $this->config = new Config();
        $this->reader = new PhpDocReader($this->config->source);
    }

}