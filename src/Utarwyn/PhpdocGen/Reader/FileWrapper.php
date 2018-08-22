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

    public function analyze()
    {
        $tokens = token_get_all(file_get_contents($this->file), TOKEN_PARSE);
        $builder = new NodeBuilder();

        foreach ($tokens as $token) {
            if (is_array($token)) {
                $id = $token[0];
                $content = $token[1];

                switch ($id) {
                    case \T_FUNCTION:
                    case \T_CLASS:
                    case \T_INTERFACE:
                        $builder->createNode($id);
                        break;
                    case \T_VARIABLE:
                        // TODO Only get variables inside a class!
                        if (is_null($builder->getNode())) {
                            $builder->createNode($id);
                            $builder->getNode()->setName(ltrim($content, '$'));
                        }
                        break;
                    case \T_PUBLIC:
                    case \T_PRIVATE:
                    case \T_PROTECTED:
                    case \T_FINAL:
                    case \T_STATIC:
                        $builder->addMetadataForNextNode($id);
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
                if ($token === "{" || $token === ";") {
                    $builder->endBuildingCurrentNode();
                }
            }
        }

        var_dump($builder->getNodes());
    }

    private function createDescriptorFromNode($node) {
        // TODO
    }

}