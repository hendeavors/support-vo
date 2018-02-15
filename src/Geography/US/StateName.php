<?php

namespace Endeavors\Support\VO\Geography\US;

use Endeavors\Support\VO\Scalar;
use Endeavors\Support\VO\ModernString;

class StateName extends Scalar\String
{
    use StateList;

    final protected function __construct($value)
    {
        if($value instanceof StateName) {
            $value = $value->get();
        }

        $this->validate($value);

        $this->value = $value;
    }

    protected function validate($value)
    {
        $value = ModernString::create($value);

        if( false === $this->all()->hasValue($value->toUpper()) ) {
            throw new Exception\InvalidStateName(sprintf("The name, %s, is invalid.", $value));
        }
    }
}
