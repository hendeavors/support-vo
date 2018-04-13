<?php

namespace Endeavors\Support\VO;


use Endeavors\Support\VO\Validators\ValueValidator;

/**
 * Represents a string
 * Perform operations on a string value object
 */
class ModernString extends Scalar\SystemString
{
    /**
     * @param string
     * @throws Endeavors\Support\VO\Exceptions\InvalidString
     */
    final protected function __construct($value)
    {
        if($value instanceof ModernString) {
            $value = $value->get();
        }

        $this->validate($value);

        $this->value = $value;
    }

    /**
     * explode the string
     *
     * @param string $glue
     * @return array
     */
    public function explode($glue = ', ')
    {
        return explode($glue, $this->get());
    }

    public function contains($character)
    {
        return false !== $this->position($character);
    }

    public function position($character)
    {
        $result = false;

        if( $this->isNotEmpty() && mb_strlen($character) > 0 ) {
            for($i = 0; $i < $this->length(); $i++ ) {
                if( false === $result && mb_strlen($character) > 0) {
                    $result = mb_strpos($this->get(), $character);
                }
            }
        }

        return $result;
    }

    public function substring($start, $length = null)
    {
        if( null === $length ) {
            $length = (int)mb_strlen($this->get());
        }

        return static::create(mb_substr($this->get(), (int)$start, (int)$length));
    }

    public function isEmpty()
    {
        return ! $this->isNotEmpty();
    }

    public function isNotEmpty()
    {
        return $this->length() > 0;
    }

    public function toLower()
    {
        return static::create(strtolower($this->get()));
    }

    public function length()
    {
        return mb_strlen($this->get());
    }

    public function __get($arg)
    {
        $that = $this;

        if( method_exists($that, $arg) ) {
            return $that->$arg();
        }
    }
}
