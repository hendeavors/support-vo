<?php

namespace Endeavors\Support\VO\Time;

use Endeavors\Support\VO\Exceptions\InvalidNumber;
use Endeavors\Support\VO\Validators\ValueValidator;
use Endeavors\Support\VO\ModernString;
use Endeavors\Support\VO\Scalar;

/**
 * Represent a length of time with integer precision, an hour specifically
 *
 */
class Hour extends Scalar\Integer\Long
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

        $computed = (int)($seconds / (60 * 60));

        return new static($computed);
    }

    /**
     * Give me a unit of hours from days
     * @param  [type] $seconds [description]
     * @return [type]          [description]
     */
    public static function fromDays($days)
    {
        $days = Scalar\IntegerImplementation::create($days);

        $days = $days->toNative();

        return new static($days * 24);
    }

    /**
     * Represent me in seconds
     * @return [type] [description]
     */
    public function toSeconds()
    {
        return Second::fromHours($this->get())->get();
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
