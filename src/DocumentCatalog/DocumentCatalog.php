<?php

namespace DocFlow\DocumentCatalog;

use DocFlow\Document;
use DocFlow\Number;

interface DocumentCatalog
{
    /**
     * @return Document[]
     */
    public function find(array $criteria): array;

    /**
     * @param Number $id
     * @return Document
     */
    public function get(Number $id): Document;

    public function save(Document $document): void;
}