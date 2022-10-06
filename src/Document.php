<?php

namespace DocFlow;

use DocFlow\NumberGenerator\NumberGenerator;

class Document
{
    private Status $status;
    private ?string $verificator;
    private Number $id;
    private string $title;
    private \DateTimeImmutable $createdAt;
    private string $author;
    private string $content;
    private Type $type;

    public function __construct(
        string $title,
        string $author,
        string $content,
        Type $type,
        Number $id
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->createdAt = new \DateTimeImmutable();
        $this->author = $author;
        $this->content = $content;
        $this->status = Status::DRAFT();
        $this->verificator = null;
        $this->type = $type;
    }

    public function verify(string $verificator)
    {
        if ($this->status != Status::DRAFT()) {
            throw new \Exception('Cannot verify document');
        }
        if($this->author == $verificator) {
            throw new \Exception('Cannot verify document by author');
        }

        $this->verificator = $verificator;
        $this->status = Status::VERIFY();
    }

    public function changeContent(string $content)
    {
        if($this->status == Status::PUBLISHED()) {
            throw new \Exception('Document published');
        }

        $this->content = $content;
        $this->status = Status::DRAFT();
        $this->verificator = null;
    }

    public function changeTitle(string $title)
    {
        if($this->status == Status::PUBLISHED()) {
            throw new \Exception('Document published');
        }

        $this->title = $title;
        $this->status = Status::DRAFT();
        $this->verificator = null;
    }

    public function publish(DocumentSigner $documentSigner)
    {
        if($this->status != Status::VERIFY()) {
            throw new \Exception('Document not verified');
        }
        $this->status = Status::PUBLISHED();
        $documentSigner->signDocument($this);
    }

    public function copy(string $author, Number $number): self
    {
        return new self(
            $this->title,
            $author,
            $this->content,
            $this->type,
            $number
        );
    }


    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string|null
     */
    public function getVerificator(): ?string
    {
        return $this->verificator;
    }

    /**
     * @return Number
     */
    public function getId(): Number
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return Type
     */
    public function getType(): Type
    {
        return $this->type;
    }

}