<?php

namespace Utarwyn\PhpdocGen\Reader;

use Utarwyn\PhpdocGen\Reader\Builder\NodeBuilder;

class FileWrapper
{

    private $file;

    private $descriptors;

    public function __construct(string $file)
    {
        $this->file = $file;
        $this->descriptors = array();
    }

    public function analyse()
    {
        $tokens = token_get_all(file_get_contents($this->file), TOKEN_PARSE);
        $builder = new NodeBuilder();

        foreach ($tokens as $token) {
            if (is_array($token)) {
                $id = $token[0];
                $content = $token[1];
                $line = $token[2];

                echo(token_name($id) . ' at line ' . $line . PHP_EOL);

                switch ($id) {
                    case \T_FINAL:
                        $builder->setNextIsFinal();
                        break;
                    case \T_STATIC:
                        $builder->setNextIsStatic();
                        break;
                    case \T_FUNCTION:
                        $builder->createNode('function');
                        break;
                    case \T_DOC_COMMENT:
                        $builder->setNextDocBlock($content);
                        break;
                    case \T_STRING:
                        $node = $builder->getNode();

                        // Name field
                        if (!is_null($node) && is_null($node->getName())) {
                            $node->setName($content);
                        }
                        break;
                }
            } else {
                if ($token === "{") {
                    var_dump($builder->getNode());
                    $builder->nodeBuildEnd();
                } else if ($token === "}") {

                }
            }
        }
    }

    private function createDescriptorFromNode($node) {
        // TODO
    }

}