<?php

namespace Endeavors\Support\VO\Scalar\Precision;

trait LeftRightPrecisionTrait
{
    public static function from($value)
    {
        $value = Precision::from($value);

        return static::create($value);
    }

    public static function create(Precision $value)
    {
        return new static($value);
    }
}
