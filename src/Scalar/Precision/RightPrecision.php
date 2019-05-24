<?php

namespace Endeavors\Support\VO\Scalar\Precision;

final class RightPrecision
{
    use LeftRightPrecisionTrait;

    private function __construct(Precision $value)
    {
        $this->value = $value;
    }
}
