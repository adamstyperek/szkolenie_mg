<?php

namespace DocFlow\NumberGenerator;

use DocFlow\Number;
use DocFlow\Type;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

class DemoGeneratorTest extends TestCase
{

    use ProphecyTrait;
    /**
     * @test
     */
    public function has_generate_number_in_demo_mode()
    {
        // GIVEN
        $type = Type::TYPE1();

        $numberGenerator = $this->prophesize(NumberGenerator::class);
        $numberGenerator->generateNumber($type)->WillReturn(new Number('abc'));
        // WHEN
        $number = new DemoGenerator($numberGenerator->reveal());

        //THEN
        $this->assertStringEndsWith('demo', $number->generateNumber($type)->getNumber());
    }
}
