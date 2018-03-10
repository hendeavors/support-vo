<?php

namespace Endeavors\Support\VO\Geography\US;

use Endeavors\Support\VO\Scalar;
use Endeavors\Support\VO\ModernString;

class StateName extends Scalar\BaseString
{
    use StateList;

    public static function fromCode($code)
    {
        $key = StateCode::create($code);

        $name = static::states()->value($key->toNativeUpper());
        // if the state code exists we'll create a statecode value object
        return new static($name);
    }

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
