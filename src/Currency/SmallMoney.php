<?php

namespace Endeavors\Support\VO\Currency;

/**
 * Small precision
 */
class SmallMoney
{
    public static function fromDollars($value)
    {
        return Money::fromDollars($value, 2);
    }

    public static function fromPounds($value)
    {
        return Money::fromPounds($value, 2);
    }
}
