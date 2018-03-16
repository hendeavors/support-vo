<?php

namespace Endeavors\Support\VO\Scalar\Floats;

use Endeavors\Support\VO\Exceptions;
use Endeavors\Support\VO\Scalar;

class SystemFloat extends Scalar\Number
{
    protected function validate($value)
    {
        $valid = false;
        // validate we are numeric
        parent::validate($value);

        try {
            // validate if the numerical value is an integer type
            // a float can be considered an integer
            $value = Scalar\IntegerImplementation::create($value)->toNative();

            $valid = true;
        } catch(Exceptions\InvalidInteger $e) {
            // if we get here, we failed integer validation
            // we'll check if we have a float later
        }

        // integer validation failed and we do not have a float
        if( ! is_float($value) && $valid === false ) {
            throw new Exceptions\InvalidFloat(sprintf("The value, %s, is not a valid float", $value));
        }

        $this->value = $value;
    }
}
