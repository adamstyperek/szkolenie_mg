<?php

use DocFlow\Document;
use DocFlow\DocumentSigner;
use DocFlow\Number;
use DocFlow\NumberGenerator\DemoGenerator;
use DocFlow\NumberGenerator\ISONumberGenerator;
use DocFlow\NumberGenerator\NumberGenerator;
use DocFlow\Status;
use DocFlow\Type;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;

class DocumentTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @test
     */
    public function can_create_new_document_correct() {
        $type = Type::TYPE1();

        $document = $this->get_test_document();

        $this->assertEquals('test title', $document->getTitle());
        $this->assertEquals('test content', $document->getContent());
        $this->assertEquals('author1', $document->getAuthor());
        $this->assertEquals($type, $document->getType());
        $this->assertEquals(Status::DRAFT(), $document->getStatus());

    }

    /**
     * @test
     */
    public function cannot_change_document_content_when_published()
    {
        $this->expectException(Exception::class);

        $document = $this->get_test_document();
        $document->verify('verificatorId');
        $document->publish($this->getDocumentSigner()->reveal());

        $document->changeContent('changed contnet');
    }

    /**
     * @test
     */
    public function when_document_is_published_then_sign_document_method_is_called()
    {
        $document = $this->get_test_document();
        $document->verify('verificatorId');
        $documentSigner = $this->getDocumentSigner();
        $document->publish($documentSigner->reveal());
        $documentSigner->signDocument($document)->shouldBeCalled();
    }

    /**
     * @test
     */
    public function cannot_change_document_title_when_published()
    {
        $this->expectException(Exception::class);

        $document = $this->get_test_document();
        $document->verify('verificatorId');
        $document->publish($this->getDocumentSigner()->reveal());

        $document->changeTitle('changed title');
    }

    /**
     * @test
     */
    public function cannot_publish_document_when_not_verified()
    {
        $this->expectException(Exception::class);

        $document = $this->get_test_document();

        $document->publish($this->getDocumentSigner()->reveal());
    }

    /**
     * @test
     */
    public function when_verified_document_content_is_changed_then_has_draft_status()
    {
        $document = $this->get_test_document();
        $document->verify('verificatorId');

        $document->changeContent('changed content');

        $this->assertEquals(Status::DRAFT(), $document->getStatus());
    }

    /**
     * @test
     */
    public function when_verified_document_title_is_changed_then_has_draft_status()
    {
        $document = $this->get_test_document();
        $document->verify('verificatorId');

        $document->changeTitle('changed title');

        $this->assertEquals(Status::DRAFT(), $document->getStatus());
    }

    /**
     * @test
     */
    public function document_cannot_be_verified_by_document_author()
    {
        $this->expectException(Exception::class);

        $document = $this->get_test_document();

        $document->verify($document->getAuthor());
        
    }

    /**
     * @test
     */
    public function verified_document_has_correct_status_and_verificator()
    {
        $document = $this->get_test_document();
        $document->verify('verificatiorId');

        $this->assertEquals(Status::VERIFY(), $document->getStatus());

        $this->assertEquals('verificatiorId', $document->getVerificator());
    }

    /**
     * @test
     */
    public function copied_document_has_diff_id_and_given_author()
    {
        $document = $this->get_test_document();
        $newNumber =  $this->createNumberGenerator()->generateNumber(Type::TYPE1());

        $newDocument = $document->copy('newAuthor', $newNumber);

        $this->assertEquals($document->getId(), $newNumber);
        $this->assertEquals('newAuthor', $newDocument->getAuthor());
        $this->assertEquals(Status::DRAFT(), $newDocument->getStatus());
        $this->assertEquals($document->getTitle(), $newDocument->getTitle());
        $this->assertNull($newDocument->getVerificator());
        $this->assertEquals($document->getContent(), $newDocument->getContent());
        $this->assertEquals($document->getType(), $newDocument->getType());
        $this->assertTrue($document->getCreatedAt() < $newDocument->getCreatedAt());
    }

    private function get_test_document(): Document
    {
        $type = Type::TYPE1();
        $numberGenerator = $this->createNumberGenerator();
        $number = $numberGenerator->generateNumber($type);
        return new Document(
            'test title',
            'author1',
            'test content',
            $type,
            $number
        );
    }

    private function createNumberGenerator(): NumberGenerator
    {
        $numberGenerator = $this->prophesize(NumberGenerator::class);
        $numberGenerator->generateNumber(Argument::type(Type::class))->WillReturn(new Number('abc'), new Number('def'));

        return $numberGenerator->reveal();
    }

    private function getDocumentSigner() {
        $documentSigner = $this->prophesize(DocumentSigner::class);
        $documentSigner->signDocument(Argument::type(Document::class))->willReturn('some String');
        return $documentSigner;
    }
}
