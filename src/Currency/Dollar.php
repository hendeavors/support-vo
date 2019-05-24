<?php

namespace Endeavors\Support\VO\Currency;

use Endeavors\Support\VO\Scalar;
use Endeavors\Support\VO\Contracts;

/**
 * Represents a dollar
 */
final class Dollar
{
    use DollarConversion;

    private $value;

    /**
     * translator for the money, a currency symbol
     * @var Contracts\ITranslator
     * @todo what are valid currency units?
     */
    private $translator;

    /**
     * The precision
     * @var Scalar\Integer\Integer
     */
    private $precision;

    private function __construct(float $value, Contracts\ITranslator $translator, Scalar\Integer\Integer $precision)
    {
        $this->translator = $translator;

        $this->precision = $precision;

        $this->value = $value;
    }

    public static function create(float $value, int $precision)
    {
        return new static($value, Translator::fromCode(CurrencyCodeAlpha::USD()), Scalar\IntegerImplementation::create($precision));
    }

    public function add(float $value)
    {
        return static::create($this->value + $value, $this->precision->toNative());
    }

    public function subtract(float $value)
    {
        return $this->add(-$value);
    }

    public function toNative()
    {
        return $this->get();
    }

    public function get()
    {
        return round($this->value, $this->precision->toNative());
    }

    public function __toString()
    {
        return strval($this->translator->toSymbol() . $this->get());
    }

    /**
     * Check object equality
     * @param  float $value
     * @return bool is equal
     */
    public function equals($value)
    {
        return $this->value == $value;
    }

    /**
     * Check identity of the actual value
     * @param  float $value
     * @return bool is identical
     */
    public function identical($value)
    {
        return $this->value === $value;
    }
}
