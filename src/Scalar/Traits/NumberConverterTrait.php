<?php

namespace Endeavors\Support\VO\Scalar\Traits;

trait NumberConverterTrait
{
    /**
     * Convert to a number from a dollar
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public static function fromDollar($value)
    {
        return new static($this->convertValue($value));
    }

    protected function convertValue($number)
    {
       // Set the scale for the number to the scale value passed in
        $number = bcadd(
            $this->bigNumber($number),
            '0',
            $this->getScale()
        );

        return $number;
    }

    protected function bigNumber($value)
    {
        return filter_var(
            $value,
            FILTER_SANITIZE_NUMBER_FLOAT,
            FILTER_FLAG_ALLOW_FRACTION
        );
    }
}
