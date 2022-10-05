<?php

namespace DocFlow\NumberGenerator;


use DocFlow\Type;
use Lcobucci\Clock\FrozenClock;
use PHPUnit\Framework\TestCase;

class QEPNumberGeneratorTest extends TestCase
{
    /**
     * @test
     */
    public function generate_number_has_valid_date_an_type()
    {
        //GIVEN
        $type = Type::TYPE1();
        $clock = new FrozenClock( new \DateTimeImmutable('2022-10-05 18:49:30'));
        $generator = new QEPNumberGenerator($clock);
        //WHEN
        $number = $generator->generateNumber($type);
        //THEN
        $this->assertStringStartsWith('QE', $number->getNumber());
        $this->assertStringContainsString($clock->now()->format('Y/m/d'), $number->getNumber());
        $this->assertStringEndsWith($type, $number->getNumber());
    }
}
