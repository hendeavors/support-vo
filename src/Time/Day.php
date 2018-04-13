<?php

namespace Endeavors\Support\VO\Time;

use Endeavors\Support\VO\Exceptions\InvalidNumber;
use Endeavors\Support\VO\Validators\ValueValidator;
use Endeavors\Support\VO\ModernString;
use Endeavors\Support\VO\Scalar;

/**
 * Represent a length of time, a day specifically
 *
 */
class Day extends Scalar\Integer\Long
{
    /**
     * Give me a unit of days from seconds
     * @param  [type] $seconds [description]
     * @return [type]          [description]
     */
    public static function fromSeconds($seconds)
    {
        $seconds = Scalar\IntegerImplementation::create($seconds);

        $seconds = $seconds->toNative();

        return new static($seconds / (24 * 60 * 60));
    }

    public static function fromCalendarMonth($month, $year)
    {
        $month = Scalar\IntegerImplementation::create($month)->toNative();

        $year = Scalar\IntegerImplementation::create($year)->toNative();

        return new static(cal_days_in_month(CAL_GREGORIAN, $month, $year));
    }

    /**
     * Represent me in seconds
     * @return [type] [description]
     */
    public function toSeconds()
    {
        return Second::fromDays($this->get())->get();
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
