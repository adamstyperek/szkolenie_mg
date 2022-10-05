<?php

namespace DocFlow\NumberGenerator;

use DocFlow\Number;
use DocFlow\Type;
use Lcobucci\Clock\Clock;

class ISONumberGenerator implements NumberGenerator
{


    private Clock $clock;

    public function __construct(Clock $clock)
    {
        $this->clock = $clock;
    }

    public function generateNumber(Type $type): Number
    {
        $date = $this->clock->now();
        return new Number(
            $date->format('Y/m/d') .
            uniqid('-', true) .
            '-' .
            $type->getValue()
        );
    }
}
