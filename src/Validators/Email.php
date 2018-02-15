<?php

namespace Endeavors\Support\VO\Validators;

use Endeavors\Support\VO\Exceptions;

class Email
{
    public function validate($value)
    {
        if( false === filter_var($value, FILTER_VALIDATE_EMAIL) ) {
            throw new Exceptions\InvalidEmail("Value is not a valid email address");
        }
    }
}
