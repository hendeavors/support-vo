<?php

namespace Endeavors\Support\VO\Scalar\Precision;

use Endeavors\Support\VO\Scalar\IntegerImplementation;

final class Precision
{
    private $value;
    
    /**
     * @todo do we need to hint if the only
     * path to construction are the factory methods?
     */
    private function __construct($value)
    {
        $this->value = $value;
    }

    public static function from($value)
    {
        $value = IntegerImplementation::create($value);

        return static::create($value);
    }

    public static function create(IntegerImplementation $value)
    {
        return new static($value);
    }
}
