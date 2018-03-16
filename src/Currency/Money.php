<?php

namespace Endeavors\Support\VO\Currency;

use Endeavors\Support\VO\Scalar\Floats;

/**
 * For now we'll define dollar implementations
 */
class Money extends Floats\Float
{
    /**
     * [protected description]
     * @var [type]
     * @todo what are valid currency units?
     */
    protected $representation;
    /**
     * Money
     * @param [type] $value          [description]
     * @param [type] $currencySymbol [description]
     * @todo define currencySymbol
     */
    final protected function __construct($value, $representation)
    {
        $this->validate($value);

        if( $representation instanceof CurrencyCodeAlpha ) {
            $this->representation = Translator::fromCode($representation)->toSymbol();
        } elseif( $representation instanceof CurrencySymbol ) {
            $this->representation = Translator::fromSymbol($representation)->toCode();
        }

        $this->value = $value;
    }

    public static function fromDollars($value)
    {
        return new static($value, CurrencyCodeAlpha::USD());
    }

    public static function fromPounds($value)
    {
        return new static($value, CurrencyCodeAlpha::GBP());
    }

    public function inPounds()
    {
        // @todo need to define currencyUnits
    }

    public function inDollars()
    {
        
    }

    public function __toString()
    {
        return $this->currencySymbol . ' ' . $this->value;
    }
    // Money::create()->inDollars()
    // Money::fromPounds()->inDollars()
}
