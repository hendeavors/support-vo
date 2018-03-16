<?php

namespace Endeavors\Support\VO\Scalar;

use Endeavors\Support\VO\Exceptions\InvalidNumber;
use Endeavors\Support\VO\Validators\ValueValidator;

/**
 * Represent a number
 *
 */
abstract class Number extends ValueValidator
{
    protected function validate($value)
    {
        if( ! is_numeric($value) ) {
            throw new InvalidNumber("The argument cannot be of type " . gettype($value));
        }
    }

    public function __toString()
    {
        return strval($this->get());
    }
}
