<?php

namespace DocFlow\NumberGenerator;

use DocFlow\Type;
use Lcobucci\Clock\FrozenClock;
use PHPUnit\Framework\TestCase;

class ISONumberGeneratorTest extends TestCase
{

    /**
     * @test
     */
    public function generate_number_has_valid_date_an_type()
    {
        //GIVEN
        $type = Type::TYPE1();
        $clock = new FrozenClock( new \DateTimeImmutable('2022-10-05 18:49:30'));
        $isoNumberGenerator = new ISONumberGenerator($clock);
        //WHEN
        $number = $isoNumberGenerator->generateNumber($type);
        //THEN
        $this->assertStringStartsWith($clock->now()->format('Y/m/d'), $number->getNumber());
        $this->assertStringEndsWith($type, $number->getNumber());
    }
}
