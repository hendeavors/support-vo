<?php

namespace Endeavors\Support\VO\Time;

use Endeavors\Support\VO\Exceptions\InvalidNumber;
use Endeavors\Support\VO\Validators\ValueValidator;
use Endeavors\Support\VO\ModernString;
use Endeavors\Support\VO\Scalar;

/**
 * Represent a number
 *
 */
class Second extends Scalar\Integer\Long
{
    public static function fromDays($days)
    {
        $days = Scalar\IntegerImplementation::create($days);

        $seconds = $days->toNative() * 24 * 60 * 60;

        return new static($seconds);
    }

    public function get()
    {
        return $this->value;
    }

    public function __toString()
    {
        return strval($this->get());
    }
}
