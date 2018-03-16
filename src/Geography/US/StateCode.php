<?php

namespace Endeavors\Support\VO\Geography\US;

use Endeavors\Support\VO\Scalar;
use Endeavors\Support\VO\ModernString;

class StateCode extends Scalar\SystemString
{
    use StateList;

    /**
     * Create A StateCode from a state
     * @param  [type] $name [description]
     * @return [type]       [description]
     */
    public static function fromState($name)
    {
        $value = StateName::create($name);

        $code = static::states()->search($value->toUpper());
        // if the state name exists we'll create a statecode value object
        return new static($code);
    }

    public function toNativeUpper()
    {
        return strval($this->toUpper()->get());
    }

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
