<?php

namespace DocFlow\DocumentsRepository;

use mysql_xdevapi\Collection;

interface DocumentsRepository
{
    public function get(Number $documentId): ?Document;

    public function save(Document $document): void;

    /**
     * @return Document[]
     */
    public function find(array $criteria): array;

    public function remove(Number $ducId): bool;
}
