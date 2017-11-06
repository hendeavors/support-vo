<?php

namespace Endeavors\Support\VO;

use Endeavors\Support\VO\Exceptions\InvalidString;

class ModernString
{
    protected $modernString;

    private function __construct($string)
    {
        if( ! is_string($string) ) {
            throw new InvalidString("The argument cannot be of type " . gettype($string));
        }

        $this->modernString = $string;
    }

    public static function create($string)
    {
        return new static($string);
    }

    public function explode($glue = ', ')
    {
        return explode($glue, $this->get());
    }

    public function contains($character)
    {
        return $this->position($character) > 0;
    }

    public function position($character)
    {
        $result = 0;
        
        if( $this->hasLength() && mb_strlen($character) > 0 ) {
            for($i = 0; $i < $this->length(); $i++ ) {
                if( 0 === $result && mb_strlen($character) > 0) {
                    $result = mb_strpos($this->get(), $character);
                }
            }
        }
        
        return $result;
    }

    public function isEmpty()
    {
        return ! $this->isNotEmpty();
    }

    public function isNotEmpty()
    {
        return $this->length() > 0;
    }

    public function length()
    {
        return strlen($this->get());
    }

    public function get()
    {
        return $this->modernString;
    }

    public function __toString()
    {
        return $this->get();
    }
}