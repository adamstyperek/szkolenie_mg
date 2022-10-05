<?php

namespace DocFlow\NumberGenerator;

use DocFlow\Number;
use DocFlow\Type;

class AuditGenerator implements NumberGenerator
{
    private NumberGenerator $generator;

    public function __construct(NumberGenerator $generator)
    {
        $this->generator = $generator;
    }

    public function generateNumber(Type $type): Number
    {
        return new Number('audit-' . $this->generator->generateNumber($type)->getNumber());
    }
}