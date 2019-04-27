<?php

namespace Endeavors\Support\VO\Scalar\Precision;

final class LeftPrecision
{
    use LeftRightPrecisionTrait;

    private $value;

    private function __construct($value)
    {
        $this->value = $value;
    }
}
