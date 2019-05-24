<?php

namespace Endeavors\Support\VO\Currency;

use Endeavors\Support\VO\Scalar;
use Endeavors\Support\VO\Contracts;

/**
 * For now we'll define dollar implementations
 * @todo represent money alternate currencies in some other object
 */
final class Money
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
     * Dollar
     * @param [type] $value          [description]
     * @param [type] $currencySymbol [description]
     * @todo define currencySymbol
     */
    private function __construct($value, $representation, $precision)
    {
        $this->representation = $representation;

        $this->precision = $precision;

        $this->value = $value;
    }

    public static function fromDollars(float $value, $precision = 2)
    {
        return Dollar::create($value, $precision);
    }

    public static function fromPounds(float $value, $precision = 2)
    {
        return static::from($value, Translator::fromCode(CurrencyCodeAlpha::GBP()), $precision);
    }

    public static function from($value, Contracts\ITranslator $translator, $precision)
    {
        $precision = Scalar\IntegerImplementation::create($precision);

        $value = Scalar\Floats\SystemFloat::create($value);

        return new static($value, $translator, $precision);
    }

    public function toNative()
    {
        return $this->get();
    }

    public function get()
    {
        return round($this->value->toNative(), $this->precision->toNative());
    }

    public function __toString()
    {
        return \strval($this->representation->toSymbol() . $this->get());
    }

    /**
     * Check object equality
     * @param  float $value
     * @return bool is equal
     */
    public function equals($value)
    {
        return $this->value->equals($value);
    }

    /**
     * Check identity of the actual value
     * @param  float $value
     * @return bool is identical
     */
    public function identical($value)
    {
        return $this->value->identical($value);
    }
}
