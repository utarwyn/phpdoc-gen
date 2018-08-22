<?php

namespace Utarwyn\PhpdocGen\Reader\Analyzer;

class FileAnalyzer
{

    private $file;

    public function __construct(string $file)
    {
        $this->file = $file;
    }

    public function analyse()
    {
        $tokens = token_get_all(file_get_contents($this->file));

        foreach ($tokens as $token) {
            if (is_array($token)) {
                echo "Line {$token[2]}: ", token_name($token[0]), " ('" . htmlspecialchars($token[1]) . "')", PHP_EOL;
            }
        }
    }

}