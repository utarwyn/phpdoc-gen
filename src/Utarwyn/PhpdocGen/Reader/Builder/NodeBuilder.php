<?php

namespace Utarwyn\PhpdocGen\Reader\Builder;

class NodeBuilder
{

    private $node;

    private $nextMetadatas;

    private $nextDocBlock;

    private $nodes;

    public function __construct()
    {
        $this->node = null;
        $this->nextMetadatas = array();
        $this->nextDocBlock = null;
        $this->nodes = array();
    }

    public function getNodes()
    {
        return $this->nodes;
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
        if ($this->isBuildingElement()) {
            $this->endBuildingCurrentNode();
        }

        $this->node = new Node($type);

        // Apply previous stated fields
        foreach ($this->nextMetadatas as $metadata) {
            $this->node->addMetadata($metadata);
        }

        if (!is_null($this->nextDocBlock)) {
            $this->node->setDocumentation($this->nextDocBlock);
        }
    }

    public function addMetadataForNextNode(int $metadata)
    {
        array_push($this->nextMetadatas, $metadata);
    }

    public function setNextDocBlock(string $nextDocBlock)
    {
        $this->nextDocBlock = $nextDocBlock;
    }

    public function endBuildingCurrentNode()
    {
        if ($this->isBuildingElement()) {
            array_push($this->nodes, $this->node);

            $this->node = null;
            $this->nextMetadatas = array();
            $this->nextDocBlock = null;
        }
    }

}