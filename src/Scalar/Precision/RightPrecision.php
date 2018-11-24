<?php

namespace Endeavors\Support\VO\Scalar\Precision;

use LeftRightPrecisionTrait;

final class RightPrecision
{
    use LeftRightPrecisionTrait;

    private function __construct(Precision $value)
    {
        $this->value = $value;
    }
}
