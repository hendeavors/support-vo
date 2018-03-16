<?php

namespace Endeavors\Support\VO\Currency;

/**
 * Common precision
 */
class CommonMoney
{
    public static function fromDollars($value)
    {
        return Money::fromDollars($value, 4);
    }

    public static function fromPounds($value)
    {
        return Money::fromPounds($value, 4);
    }
}
