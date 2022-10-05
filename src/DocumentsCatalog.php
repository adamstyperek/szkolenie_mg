<?php

namespace DocFlow;

use DocFlow\DocumentsRepository\DocumentsRepository;

class DocumentsCatalog
{
    
    private DocumentsRepository $documentsRepository;

    public function __construct(DocumentsRepository $documentsRepository)
    {
        $this->documentsRepository = $documentsRepository;
    }

    /**
     * @return Document[]
     */
    public function find(array $criteria): array
    {
    }

    /**
     * @param Number $id
     * @return Document
     */
    public function get(Number $id): Document
    {
    }
}