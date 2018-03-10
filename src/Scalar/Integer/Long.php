<?php

namespace Endeavors\Support\VO\Scalar\Integer;

use Endeavors\Support\VO\Scalar;
use Endeavors\Support\VO\Exceptions\InvalidLong;

class Long extends Scalar\Number
{
    const MIN = '-9223372036854775808';

    const MAX = '9223372036854775807';

    const TRUE_MIN = '\'' . -PHP_INT_MAX . '\'';

    public static function native($value)
    {
        return new static($value);
    }

    final protected function __construct($value)
    {
        $this->validate($value);

        $this->value = $value;
    }

    protected function validate($value)
    {
        parent::validate($value);

        dump((int)self::TRUE_MIN);

        $value = $this->convertValue($value);

        if( $this->lessThanMinimum($value) || $this->moreThanMaximum($value) ) {
            $this->throwException($value);
        }
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

    protected function getScale()
    {
        return ini_get('bcmath.scale');
    }

    /**
     * Compares the current number with the given number
     *
     * Returns 0 if the two operands are equal, 1 if the current number is
     * larger than the given number, -1 otherwise.
     *
     * @param mixed $number May be of any type that can be cast to a string
     *                      representation of a base 10 number
     * @return int
     * @link http://www.php.net/bccomp
     */
    protected function compareTo($value, $number)
    {
        return bccomp(
            $value,
            $number,
            $this->getScale()
        );
    }

    protected function lessThanMinimum($value)
    {
        return $this->compareTo($value, self::MIN) < 0;
    }

    protected function moreThanMaximum($value)
    {
        return $this->compareTo($value, self::MAX) > 0;
    }

    private function throwException($value)
    {
        throw new InvalidLong(sprintf("The value, %s, is out of range.", $value));
    }
}
