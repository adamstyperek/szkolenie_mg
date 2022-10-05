<?php

namespace DocFlow\NumberGenerator;

use DocFlow\Number;
use DocFlow\Type;

class DemoGenerator implements NumberGenerator
{

    private NumberGenerator $generator;

    public function __construct(NumberGenerator $generator)
    {
        $this->generator = $generator;
    }

    public function generateNumber(Type $type): Number
    {
        return new Number($this->generator->generateNumber($type)->getNumber() . '-demo');
    }
}