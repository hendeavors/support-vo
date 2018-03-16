<?php

namespace Endeavors\Support\VO\Scalar\Integer;

use Endeavors\Support\VO\Scalar;
use Endeavors\Support\VO\Exceptions;

/**
 * [abstract description]
 * @var [type]
 * We abstract the type as it doesn't provide much practical support outside of phps long integer type
 */
abstract class Integer extends Scalar\Number
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
            throw new Exceptions\InvalidInteger(sprintf("The type, %s, is invalid.", gettype($value)));
        }
    }

    public function toNative()
    {
        return (int)$this->get();
    }
}
