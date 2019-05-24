<?php

namespace Endeavors\Support\VO\Scalar\Precision;

final class DecimalPrecision
{
    private $leftPrecision;

    private $rightPrecision;

    private function __construct($leftPrecision, $rightPrecision)
    {
        $this->leftPrecision = $leftPrecision;

        $this->rightPrecision = $rightPrecision;
    }

    public static function from($leftPrecision, $rightPrecision)
    {
        return new static($leftPrecision, $rightPrecision);
    }

    public static function create(LeftPrecision $leftPrecision, RightPrecision $rightPrecision)
    {
        return new static($leftPrecision, $rightPrecision);
    }

    public function getLeftPrecision()
    {
        return $this->leftPrecision;
    }

    public function getRightPrecision()
    {
        return $this->rightPrecision;
    }
}
