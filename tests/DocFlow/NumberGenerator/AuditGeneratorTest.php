<?php

namespace DocFlow\NumberGenerator;

use DocFlow\Number;
use DocFlow\Type;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;

class AuditGeneratorTest
{
    use ProphecyTrait;
    /**
     * @test
     */
    public function has_generate_number_in_demo_mode()
    {
        // GIVEN
        $numberGenerator = $this->prophesize(NumberGenerator::class);
        $numberGenerator->generateNumber(Argument::type(Type::class))->WillReturn(new Number('abc'));
        // WHEN
        $number = new DemoGenerator($numberGenerator->reveal());

        //THEN
        $this->assertStringStartWith('audit-', $number->generateNumber(rgument::type(Type::class))->getNumber());
    }


}