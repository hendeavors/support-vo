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
    final protected function __construct($value)
    {
        $this->validate($value);

        $this->value = $value;
    }

    protected function validate($value)
    {
        if( ! ($value instanceof \DateTimeInterface) ) {
            ModernString::create($value);
        }
    }

    public static function now()
    {
        return new static(\DateTime::now());
    }

    public static function fromNow()
    {
        return static::now();
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
        $value = $date;
        // if instance of datetimeinterface
        if( ! ($date instanceof \DateTimeInterface) ) {
            $value = new \DateTime($date);
        }

        return new static($value);
    }

    public function next()
    {
        $dt = $currentDate = $this->value;

        $day = $dt->format('j');
        $dt->modify('first day of +1 month');

        $dt->modify('+' . (min($day, $dt->format('t')) - 1) . ' days');

        return new static($dt);

        $nextMonthNumericValue = $this->currentNumericalMonth() + 1;
        // todo account for leap year
        if( $nextMonthNumericValue == 2 && $this->currentNumericalDay() > $this->nextMonthToDays() ) {
            return new static(new \DateTime(date($this->currenctNumericalYear() . '-' . 02 . '-' . 28)));
        } elseif( $nextMonthNumericValue == 2 ) {
            return new static(new \DateTime(date($this->currenctNumericalYear() . '-' . 02 . '-' . $this->currentNumericalDay())));
        } elseif( $nextMonthNumericValue == 6 && $this->currentNumericalDay() > $this->nextMonthToDays() ) {
            return new static(new \DateTime(date($this->currenctNumericalYear() . '-' . 06 . '-' . 30)));
        } elseif( $nextMonthNumericValue == 6 ) {
            return new static(new \DateTime(date($this->currenctNumericalYear() . '-' . 06 . '-' . $this->currentNumericalDay())));
        }

        return new static($currentDate->modify('+1 month'));
    }

    public function toDays()
    {
        return cal_days_in_month(CAL_GREGORIAN, $this->currentNumericalMonth(), $this->currenctNumericalYear());
    }

    public function toSeconds()
    {
        return Second::fromDays($this->toDays())->get();
    }

    public function toDateTime()
    {
        return $this->value;
    }

    public function get()
    {
        return $this->toDateTime()->format('F');
    }

    public function __toString()
    {
        return strval($this->get());
    }

    public function nextMonthToDays()
    {
        return cal_days_in_month(CAL_GREGORIAN, $this->currentNumericalMonth()+1, $this->currenctNumericalYear());
    }

    protected function currenctNumericalYear()
    {
        return (int)$this->value->format('Y');
    }

    protected function currentNumericalMonth()
    {
        return (int)$this->value->format('m');
    }

    protected function currentNumericalDay()
    {
        return (int)$this->value->format('d');
    }
}
