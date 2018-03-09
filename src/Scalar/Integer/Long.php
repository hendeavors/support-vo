<?php

namespace Endeavors\Support\VO\Scalar\Integer;

use Endeavors\Support\VO\Scalar;

class Long extends Scalar\Number;
{
    final protected function __construct($value)
    {
        $this->validate($value);

        $this->value = $value;
    }

    protected function validate($value)
    {
        parent::validate($value);

        if( ! is_int($value) ) {
            throw new InvalidInteger(sprintf("The type, %s, is invalid.", gettype($value)));
        }
    }
}
