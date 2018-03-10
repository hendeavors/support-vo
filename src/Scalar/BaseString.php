<?php

namespace Endeavors\Support\VO\Scalar;

use Endeavors\Support\VO\Exceptions\InvalidString;
use Endeavors\Support\VO\Validators\ValueValidator;

/**
 * Represent a string
 *
 */
abstract class BaseString extends ValueValidator
{
    protected function validate($value)
    {
        if( ! is_string($value) ) {
            throw new InvalidString("The argument cannot be of type " . gettype($value));
        }
    }

    public function toUpper()
    {
        return static::create(strtoupper($this->get()));
    }

    public function __toString()
    {
        return $this->get();
    }
}
