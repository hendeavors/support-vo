<?php

namespace Endeavors\Support\VO\Scalar\Integer;

use Endeavors\Support\VO\Scalar;
use Endeavors\Support\VO\Exceptions\InvalidLong;
use Endeavors\Support\VO\Exceptions\InvalidNumber;
use Endeavors\Support\VO\Platform;

/**
 * A long is defined being between -9223372036854775808 and 9223372036854775807 inclusive
 * To support a long on 32bit architectures we must compare numerical values as strings
 * @todo consider moving constants into Architecture
 * Usage here would be to support a more complicated object which requires long integer constraints
 * We abstract the type as it doesn't provide much practical support outside of phps long integer type
 */
abstract class Long extends Scalar\Number
{
    const MIN = '-9223372036854775808';

    const MAX = '9223372036854775807';

    protected $useNativeValue = false;

    public static function native($value)
    {
        return new static($value, true);
    }

    final protected function __construct($value, $useNativeValue = false)
    {
        $this->useNativeValue = $useNativeValue;

        $this->validate($value);

        if(true === $this->useNativeValue && Platform\Architecture::isModern()) {
            $value = (int)$value;
        }

        $this->value = $value;
    }

    /**
     * Validate the argument. If the value floats
     * On a 32bit platform we'll throw an exception
     * @param  [type] $value [description]
     * @return [type]        [description]
     * @todo some refactoring
     */
    protected function validate($value)
    {
        parent::validate($value);

        if(is_float($value)) {
            $this->throwException($value);
        }

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

    protected function lessThanMinimum($value)
    {
        return $this->compareTo($value, self::MIN) < 0;
    }

    /**
     * Determine if the value is higher
     * @param  [type] $value [description]
     * @return bool        [description]
     */
    protected function moreThanMaximum($value)
    {
        return $this->compareTo($value, self::MAX) > 0;
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

    private function throwException($value)
    {
        throw new InvalidLong(sprintf("The value, %s, is out of range.", $value));
    }
}
