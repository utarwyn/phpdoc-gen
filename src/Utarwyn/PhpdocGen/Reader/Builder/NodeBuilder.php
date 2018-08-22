<?php

namespace Utarwyn\PhpdocGen\Reader\Builder;

class NodeBuilder
{

    private $node;

    private $nextIsStatic;

    private $nextIsFinal;

    private $nextDocBlock;

    public function __construct()
    {
        $this->node = null;
        $this->nextIsStatic = false;
        $this->nextIsFinal = false;
        $this->nextDocBlock = null;
    }

    public function getNode(): ?Node
    {
        return $this->node;
    }

    public function isBuildingElement(): bool
    {
        return !is_null($this->node);
    }

    public function createNode(string $type)
    {
        $this->node = new Node($type);

        // Apply previous stated fields
        if ($this->nextIsFinal) {
            $this->node->addMetadata('final');
        }
        if ($this->nextIsStatic) {
            $this->node->addMetadata('static');
        }
        if (!is_null($this->nextDocBlock)) {
            $this->node->setDocumentation($this->nextDocBlock);
        }
    }

    public function setNextIsStatic()
    {
        $this->nextIsStatic = true;
    }

    public function setNextIsFinal()
    {
        $this->nextIsFinal = true;
    }

    public function setNextDocBlock(string $nextDocBlock)
    {
        $this->nextDocBlock = $nextDocBlock;
    }

    public function nodeBuildEnd()
    {
        if ($this->isBuildingElement()) {
            $this->node = null;
            $this->nextIsStatic = false;
            $this->nextIsFinal = false;
            $this->nextDocBlock = null;
        }
    }

}