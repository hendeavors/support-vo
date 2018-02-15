<?php

namespace Endeavors\Support\VO\Validators;

abstract class ValueValidator
{
    protected $value;

    protected function __construct($value)
    {
        $this->validate($value);

        $this->value = $value;
    }

    /**
     * [abstract description]
     * @var [type]
     */
    abstract protected function validate($value);

    /**
     * Factory creation
     *
     * @return this
     */
    public static function create($string)
    {
        return new static($string);
    }

    public function get()
    {
        return $this->value;
    }
}
