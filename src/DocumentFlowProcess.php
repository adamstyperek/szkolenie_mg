<?php

namespace DocFlow;

use DocFlow\DocumentCatalog\DocumentCatalog;

class DocumentFlowProcess
{
    private DocumentCatalog $documentsCatalog;

    public function __construct(DocumentsCatalog $documentsCatalog)
    {
        $this->documentsCatalog = $documentsCatalog;
    }

    public function create(string $author,string $title, string $content, Type $type)
    {

    }

    /**
     * @param Number $idDocument
     * @param string $title
     * @param string $content
     * @return void
     */
    public function changeDocument(Number $idDocument, string $title, string $content)
    {

    }

    public function verify(Number $idDocument, string $verificator)
    {
    }

    public function publish(Number $idDocument)
    {
    }

    public function archive(Number $idDocument)
    {
    }

    public function newVersion(Number $idDocument, string $author)
    {

    }
}