<?php

namespace DocFlow\NumberGenerator;

use DocFlow\Number;
use DocFlow\Type;
use Lcobucci\Clock\Clock;

class QEPNumberGenerator implements NumberGenerator
{


    private Clock $clock;

    public function __construct(Clock $clock)
    {
        $this->clock = $clock;
    }

    public function generateNumber(Type $type): Number
    {
        $date = $this->clock->now();
        return new Number(uniqid(
                'QE', true) .
            '-' . uniqid($date->format('Y/m/d'), true) . '-' . $type);
    }
}
