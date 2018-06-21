<?php

namespace Endeavors\Support\VO\Time;

use Endeavors\Support\VO\Exceptions\InvalidNumber;
use Endeavors\Support\VO\Validators\ValueValidator;
use Endeavors\Support\VO\ModernString;
use Endeavors\Support\VO\Scalar;

/**
 * Represent a length of time with integer precision, a week specifically
 *
 */
class Week extends Scalar\Integer\Long
{
    /**
     * Give me a unit of hours from seconds
     * @param  [type] $seconds [description]
     * @return [type]          [description]
     */
    public static function fromSeconds($value)
    {
        $computed = (int)($value / 60);

        $fromMinutes = static::fromMinutes($computed);

        return new static($fromMinutes->toNative());
    }

    public static function fromMinutes($value)
    {
        $fromHours = static::fromHours($value / 60);

        return new static($fromHours->toNative());
    }

    public static function fromHours($value)
    {
        $fromDays = static::fromDays($value / 24);

        return new static($fromDays->toNative());
    }

    /**
     * Give me a unit of weeks from days
     * @param  [type] $seconds [description]
     * @return [type]          [description]
     */
    public static function fromDays($value)
    {
        $value = Scalar\IntegerImplementation::create($value);

        $value = $value->toNative();

        return new static($value / 7);
    }

    /**
     * Represent me in seconds
     * @return int
     */
    public function toSeconds()
    {
        return $this->toMinutes() * 60;
    }

    /**
     * Represent me in minutes
     * @return int
     */
    public function toMinutes()
    {
        return $this->toHours() * 60;
    }

    /**
     * Represent me in hours
     * @return int
     */
    public function toHours()
    {
        return $this->toDays() * 24;
    }

    /**
     * Represent me in days
     * @return int
     */
    public function toDays()
    {
        return $this->get() * 7;
    }

    public function get()
    {
        return $this->value;
    }

    public function toNative()
    {
        return (int)$this->get();
    }

    public function __toString()
    {
        return strval($this->get());
    }
}
