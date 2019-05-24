<?php

namespace Endeavors\Support\VO\Scalar\Floats;

use Endeavors\Support\VO\Exceptions;
use Endeavors\Support\VO\Scalar;
use Endeavors\Support\VO\Scalar\Precision\DecimalPrecision;

final class SystemDecimal
{
    private $value;

    private $precision;

    final private function __construct($value, $precision)
    {
        $this->value = $value;

        $this->precision = $precision;
    }

    public static function from($value, $left, $right)
    {
        return static::create($value, DecimalPrecision::from($left, $right));
    }

    public static function create($value, DecimalPrecision $precision)
    {
        return new static($precision);
    }
}
