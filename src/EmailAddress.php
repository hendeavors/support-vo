<?php

namespace Endeavors\Support\VO;

/**
 * Represent a valid email address
 */
class EmailAddress extends Scalar\SystemString
{
    /**
     * Determine if we should use strict validation
     *
     * @var bool $loose
     */
    protected $loose;

    /**
     * Create the email
     * We default to a syntactically valid email
     *
     * @param string $email
     * @param bool $loose
     */
    protected function __construct($email, $loose = true)
    {
        $this->loose = $loose;

        $this->validate($email);
        // if an exception is not thrown we have a valid email
        $this->value = $email;
    }

    /**
     * Create a strict email uses
     * Standard php email validation
     *
     * @param $value
     */
    public static function strict($value)
    {
        return new static($value, false);
    }

    /**
     * Create unusual syntactically valid emails
     *
     * @param $value
     * @return this
     */
    public static function loose($value)
    {
        return new static($value, true);
    }

    protected function validate($value)
    {
        $validator = new Validators\Email;

        if( true === $this->loose ) {
            $validator = new Validators\SyntacticallyValidEmail;
        }
        // exception will be thrown if invalid
        $validator->validate($value);
    }
}
