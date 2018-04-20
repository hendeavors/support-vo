<?php

namespace Endeavors\Support\VO\Time;

use Endeavors\Support\VO\Exceptions\InvalidNumber;
use Endeavors\Support\VO\Validators\ValueValidator;
use Endeavors\Support\VO\ModernString;
use Endeavors\Support\VO\Scalar;

/**
 * Represent a length of time with integer precision, a year specifically
 *
 */
class Year extends Scalar\Integer\Long
{
    const LEAP = 366;
    const NOLEAP = 365;
    /**
     * Give me a unit of years from seconds
     * @param  [type] $seconds [description]
     * @return [type]          [description]
     */
    public static function fromSeconds($value)
    {
        $value = Scalar\IntegerImplementation::create($value);

        $value = $value->toNative();

        $computed = (int)($value / (60 * 60 * 24 * static::guessUnit()));

        return new static($computed);
    }

    /**
     * Give me a unit of years from minutes
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public static function fromMinutes($value)
    {
        $value = Scalar\IntegerImplementation::create($value);

        $value = $value->toNative();

        $computed = (int)($value / (60 * 24 * static::guessUnit()));

        return new static($computed);
    }

    /**
     * Give me a unit of years from hours
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public static function fromHours($value)
    {
        $value = Scalar\IntegerImplementation::create($value);

        $value = $value->toNative();

        $computed = (int)($value / (24 * static::guessUnit()));

        return new static($computed);
    }

    /**
     * Give me a unit of years from days
     * @param  [type] $seconds [description]
     * @return [type]          [description]
     */
    public static function fromDays($value)
    {
        $value = Scalar\IntegerImplementation::create($value);

        $value = $value->toNative();

        return new static($value / static::guessUnit());
    }

    /**
     * Give me a unit of years from weeks
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public static function fromWeeks($value)
    {
        $value = Week::create($value)->toDays();

        $computed = (int)($value / static::guessUnit());

        return new static($computed);
    }

    /**
     * Guess the unit of the year in days
     * @return [type] [description]
     */
    public static function guessUnit()
    {
        $current = (int)date('Y');

        if ( $current % 4 == 0 ) {
            return static::LEAP;
        }

        return static::NOLEAP;
    }

    /**
     * Represent me in seconds
     * @return [type] [description]
     */
    public function toSeconds()
    {
        return $this->toMinutes() * 60;
    }

    /**
     * Represent me in minutes
     * @return [type] [description]
     */
    public function toMinutes()
    {
        return $this->toHours() * 60;
    }

    /**
     * Represent me in hours
     * @return [type] [description]
     */
    public function toHours()
    {
        return $this->toDays() * 24;
    }

    /**
     * Represent me in days
     * @return [type] [description]
     */
    public function toDays()
    {
        return (int)($this->toWeeks() * 7);
    }

    /**
     * Represent me in weeks
     * @return [type] [description]
     */
    public function toWeeks()
    {
        return ($this->value * static::guessUnit()) / 7;
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
