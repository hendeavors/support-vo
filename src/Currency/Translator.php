<?php

namespace Endeavors\Support\VO\Currency;

use Endeavors\Support\VO\Contracts;

class Translator implements Contracts\ITranslator
{
    /**
     * @var \MabeEnum\Enum $translation
     */
    private $translation;

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
        if ($this->translation instanceof CurrencyCodeAlpha) {
            return $this->translation;
        }

        $key = key($this->translation->getValue());

        return CurrencyCodeAlpha::$key()->getValue()[$key];
    }

    public function toSymbol()
    {
        //
        if ($this->translation instanceof CurrencySymbol) {
            return $this->translation;
        }

        $key = key($this->translation->getValue());

        return CurrencySymbol::$key()->getValue()[$key];
    }
}
