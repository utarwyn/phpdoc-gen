<?php

namespace Utarwyn\PhpdocGen\Reader\Builder;

class Node
{

    private $type;

    private $name;

    private $documentation;

    private $metadatas;

    public function __construct(string $type)
    {
        $this->type = $type;
        $this->metadatas = array();
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getPlainDocumentation(): ?string
    {
        return $this->documentation;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setDocumentation(string $documentation)
    {
        $this->documentation = $documentation;
    }

    public function addMetadata(string $metadata)
    {
        array_push($this->metadatas, $metadata);
    }

}

