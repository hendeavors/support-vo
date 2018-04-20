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
    public static function fromSeconds($seconds)
    {
        $seconds = Scalar\IntegerImplementation::create($seconds);

        $seconds = $seconds->toNative();

        $computed = (int)($seconds / (60 * 60 * 24 * 7));

        return new static($computed);
    }

    /**
     * Give me a unit of weeks from days
     * @param  [type] $seconds [description]
     * @return [type]          [description]
     */
    public static function fromDays($days)
    {
        $days = Scalar\IntegerImplementation::create($days);

        $days = $days->toNative();

        return new static($days / 7);
    }

    /**
     * Represent me in seconds
     * @return [type] [description]
     */
    public function toSeconds()
    {
        return Second::fromWeeks($this->get())->get();
    }

    /**
     * Represent me in days
     * @return [type] [description]
     */
    public function toDays()
    {
        return $this->get() * 7;
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
