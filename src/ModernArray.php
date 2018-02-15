<?php

namespace Endeavors\Support\VO;

/**
 * We use the name ModernArray for the obvious reason array is taken
 * @todo filter,intersect,merge,explode
 */
class ModernArray
{
    protected $modernArray;
    /**
     * We can hint at the array so we don't have
     * To perform any custom validation
     * @param array $array
     */
    private function __construct(array $array)
    {
        $this->modernArray = $array;
    }

    /**
     * Factory acces to create the object
     */
    public static function create($input)
    {
        return new static((array)$input);
    }

    /**
     * Implode recursively if we need to
     * The nested relationship is lost in the conversion
     * @todo is there a better way to implode and retain nested relations
     */
    public function implode($glue = ', ')
    {
        $result = '';

        foreach($this->modernArray as $key => $next) {
            if( is_array($next) ) {
                $result .= $key . ':{' . static::create($next)->implode($glue) . '}';
            } else {
                $result .= $next . $glue;
            }
        }

        $result = trim($result, $glue);

        return $result;
    }

    /**
     * @param mixed needle
     * @deprecated
     */
    public function inArray($needle)
    {
        return in_array($needle, $this->get());
    }

    /**
     * Replaces inArray - check to see if the value is in the array
     * @param  [type]  $needle [description]
     * @return boolean         [description]
     */
    public function hasValue($needle)
    {
        return in_array($needle, $this->get());
    }

    /**
     * Check for a key
     */
    public function hasKey($key)
    {
        return array_key_exists($key, $this->get());
    }

    /**
     * @todo test
     */
    public function combine($input)
    {
        $array = static::create($input);

        return array_combine($this->modernArray,$array->get());
    }

    public function get()
    {
        return $this->modernArray;
    }

    public function __toString()
    {
        return $this->implode(',');
    }
}
