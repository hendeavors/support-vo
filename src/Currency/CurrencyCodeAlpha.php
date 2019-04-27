<?php

namespace Endeavors\Support\VO\Currency;

use MabeEnum\Enum;

/**
 * @method \MabeEnum\Enum USD()
 * @static \MabeEnum\Enum GBP()
 */
final class CurrencyCodeAlpha extends Enum
{
    const USD = ['USD' => 'USD'];
    const GBP = ['GBP' => 'GBP'];
}
