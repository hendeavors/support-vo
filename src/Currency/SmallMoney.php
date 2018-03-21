<?php

namespace Endeavors\Support\VO\Currency;

use Endeavors\Support\VO\Contracts;
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

    public static function from($value, Contracts\ITranslator $translator)
    {
        return Money::from($value, $translator, 2);
    }
}
