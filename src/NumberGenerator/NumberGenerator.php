<?php

namespace DocFlow\NumberGenerator;

use DocFlow\Number;
use DocFlow\Type;

interface NumberGenerator
{
    public function generateNumber(Type $type): Number;
}