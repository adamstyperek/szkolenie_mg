<?php

namespace DocFlow\DocumentCatalog;

use DocFlow\Document;
use DocFlow\Number;

class InMemoryDocumentCatalog implements DocumentCatalog
{


    private $documents = [];

    /**
     * @inheritDoc
     */
    public function find(array $criteria): array
    {
        return $this->documents;
    }

    /**
     * @inheritDoc
     */
    public function get(Number $id): Document
    {
        return $this->documents[$id->getNumber()];
    }


    public function save(Document $document): void
    {
        $this->documents[$document->getId()->getNumber()] = $document;
    }
}