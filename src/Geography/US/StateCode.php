<?php

namespace Endeavors\Support\VO\Geography\US;

use Endeavors\Support\VO\Scalar;

class StateCode extends Scalar\BaseString
{
    use StateList;

    final protected function __construct($value)
    {
        if($value instanceof StateCode) {
            $value = $value->get();
        }

        $this->validate($value);

        $this->value = $value;
    }

    protected function validate($value)
    {
        parent::validate($value);

        if( false === $this->all()->hasKey($value) ) {
            throw new Exception\InvalidStateCode(sprintf("The code, %s, is invalid.", $value));
        }
    }
}
