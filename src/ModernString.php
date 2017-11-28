<?php

namespace Endeavors\Support\VO;

use Endeavors\Support\VO\Exceptions\InvalidString;

/**
 * Represents a string
 */
class ModernString
{
    /**
     * The string to be used as a value object
     * 
     * @var string
     */
    protected $modernString;
    
    /**
     * @param string
     * @throws Endeavors\Support\VO\Exceptions\InvalidString
     */
    private function __construct($string)
    {
        if($string instanceof ModernString) {
            $string = $string->get();
        }
        elseif( ! is_string($string) ) {
            throw new InvalidString("The argument cannot be of type " . gettype($string));
        }

        $this->modernString = $string;
    }
    
    /**
     * Factory creation
     * 
     * @return this
     */
    public static function create($string)
    {
        return new static($string);
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

    public function toUpper()
    {
        return static::create(strtoupper($this->get()));
    }

    public function toLower()
    {
        return static::create(strtolower($this->get()));
    }

    public function length()
    {
        return mb_strlen($this->get());
    }

    public function get()
    {
        return $this->modernString;
    }

    public function __toString()
    {
        return $this->get();
    }

    public function __get($arg)
    {
        $that = $this;

        if( method_exists($that, $arg) ) {
            return $that->$arg();
        }
    }
}