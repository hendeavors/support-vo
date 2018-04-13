<?php

namespace Endeavors\Support\VO\Time;

use Endeavors\Support\VO\Exceptions\InvalidNumber;
use Endeavors\Support\VO\Validators\ValueValidator;
use Endeavors\Support\VO\ModernString;
use Endeavors\Support\VO\Scalar;

/**
 * Represent a Month
 * PHP translates +1 month to +numberofdays in given month
 * Example: January 31 will result in March 03 for a normal year
 */
class Month extends ValueValidator
{
    private $dateTime;

    final protected function __construct($value)
    {
        $this->validate($value);

        $this->dateTime = $value;
    }

    protected function validate($value)
    {
        // we expect a string if we are not a datetime
        if( ! ($value instanceof \DateTimeInterface) ) {
            ModernString::create($value);
        }
    }

    public static function create($value)
    {
        if( ! ($value instanceof \DateTimeInterface) ) {
            $value = new \DateTime(date($value));
        }

        return new static($value);
    }

    public static function fromDate($date)
    {
        return static::create($date);
    }

    public static function now()
    {
        return static::fromDate('Y-m-d H:i:s');
    }

    /**
     * Increment the current month value by 1
     * Use a plus for clarity
     * @return Endeavors\Support\VO\Time\Month
     */
    public function next()
    {
        return $this->incrementBy(+1);
    }

    /**
     * Decrement the current month value by 1
     * @return Endeavors\Support\VO\Time\Month
     */
    public function previous()
    {
        return $this->decrementBy(1);
    }

    public function toDays()
    {
        return Day::fromCalendarMonth($this->currentNumericalMonth(), $this->currenctNumericalYear())->get();
    }

    public function toSeconds()
    {
        return Second::fromDays($this->toDays())->get();
    }

    public function toDateTime()
    {
        return $this->dateTime;
    }

    /**
     * Maybe somewhat opinionated on
     * A "native" representation of a month
     * @return [type] [description]
     */
    public function toNative()
    {
        return $this->toSeconds();
    }

    public function get()
    {
        return $this->toDateTime()->format('F');
    }

    public function __toString()
    {
        return strval($this->get());
    }

    protected function decrementBy($value)
    {
        return $this->incrementBy(-$value);
    }

    protected function incrementBy($value)
    {
        $modifier = Scalar\IntegerImplementation::create($value);

        $day = $this->dateTime->format('j');
        $this->dateTime->modify('first day of ' . $modifier->toNative() . ' month');
        $this->dateTime->modify('+' . (min($day, $this->dateTime->format('t')) - 1) . ' days');
        return new static($this->dateTime);
    }

    protected function currenctNumericalYear()
    {
        return (int)$this->dateTime->format('Y');
    }

    protected function currentNumericalMonth()
    {
        return (int)$this->dateTime->format('m');
    }

    protected function currentNumericalDay()
    {
        return (int)$this->dateTime->format('d');
    }
}
