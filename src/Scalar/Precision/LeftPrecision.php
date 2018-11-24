<?php

namespace Endeavors\Support\VO\Scalar\Precision;

use LeftRightPrecisionTrait;

final class LeftPrecision
{
    use LeftRightPrecisionTrait;

    private $value;

    private function __construct($value)
    {
        $this->value = $value;
    }
}
