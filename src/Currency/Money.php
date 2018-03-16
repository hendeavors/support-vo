<?php

namespace Endeavors\Support\VO\Currency;

use Endeavors\Support\VO\Scalar;
use Endeavors\Support\VO\Contracts;

/**
 * For now we'll define dollar implementations
 */
class Money extends Scalar\Floats\SystemFloat
{
    /**
     * Representation for the money, a currency symbol
     * @var [type]
     * @todo what are valid currency units?
     */
    protected $representation;

    /**
     * The precision
     * @var [type]
     */
    protected $precision;
    /**
     * Money
     * @param [type] $value          [description]
     * @param [type] $currencySymbol [description]
     * @todo define currencySymbol
     */
    final protected function __construct($value, $representation, $precision)
    {
        $this->validate($value);

        $this->representation = $representation->toSymbol();

        $this->precision = $precision;

        $this->value = $value;
    }

    public static function fromDollars($value, $precision = 2)
    {
        return static::from($value, Translator::fromCode(CurrencyCodeAlpha::USD()), $precision);
    }

    public static function fromPounds($value, $precision = 2)
    {
        return static::from($value, Translator::fromCode(CurrencyCodeAlpha::GBP()), $precision);
    }

    public static function from($value, Contracts\ITranslator $translator, $precision)
    {
        $precision = Scalar\IntegerImplementation::create($precision);

        return new static($value, $translator, $precision);
    }

    public function get()
    {
        return round($this->value, $this->precision->toNative());
    }

    public function __toString()
    {
        return \strval($this->representation . ' ' . $this->get());
    }
}
