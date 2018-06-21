<?php

namespace Endeavors\Support\VO\Time;

use Endeavors\Support\VO\Exceptions\InvalidNumber;
use Endeavors\Support\VO\Validators\ValueValidator;
use Endeavors\Support\VO\ModernString;
use Endeavors\Support\VO\Scalar;

/**
 * Represent a length of time with integer precision, specifically a second
 *
 */
class Second extends Scalar\Integer\Long
{
    /**
     * Give me a unit of seconds from hours
     * @param  [type] $days [description]
     * @return [type]       [description]
     */
    public static function fromHours($value)
    {
        $value = Scalar\IntegerImplementation::create($value);

        $value = $value->toNative() * 60 * 60;

        return new static($value);
    }

    /**
     * Give me a unit of seconds from days
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public static function fromDays($value)
    {
        $value = static::fromHours($value);

        $value = $value->get() * 24;

        return new static($value);
    }

    /**
     * Give me a unit of seconds from weeks
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public static function fromWeeks($value)
    {
        $value = static::fromDays($value);

        $value = $value->get() * 7;

        return new static($value);
    }

    /**
     * Give me a unit of seconds from years
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public static function fromYears($value)
    {
        $value = Scalar\IntegerImplementation::create($value);

        $value = $value->toNative() * 60 * 60 * 24 * Year::guessUnit();

        return new static($value);
    }

    public function toDays()
    {
        return Day::fromSeconds($this->get())->get();
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
