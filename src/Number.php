<?php

namespace DocFlow;

class Number
{
    private string $number;
    public function __construct(string $number)
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    public static function fromString(string $number): self {
        return new Number($number);
    }

}