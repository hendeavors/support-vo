<?php

namespace Endeavors\Support\VO\Currency;

class Translator
{
    private function __construct($translation)
    {
        $this->translation = $translation;
    }

    public static function fromCode(CurrencyCodeAlpha $code)
    {
        //
        return new static($code);
    }

    public static function fromSymbol(CurrencySymbol $symbol)
    {
        //
        return new static($symbol);
    }

    public function toCode()
    {
        //
        if( $this->translation instanceof CurrencyCodeAlpha ) return $this->translation;

        return CurrencyCodeAlpha::get($this->translation);
    }

    public function toSymbol()
    {
        //
        if( $this->translation instanceof CurrencySymbol ) return $this->translation;

        return CurrencySymbol::get($this->translation);
    }
}
