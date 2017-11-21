<?php

namespace Endeavors\Support\VO;

class EmailAddress
{
    protected $email;

    private function __construct($email, $loose = true)
    {
        $validator = new Validators\Email;

        if( true === $loose ) {
            $validator = new Validators\SyntacticallyValidEmail;
        }
        
        // exception will be thrown if invalid
        if( $validator->validate($email) ) {
            $this->email = $email;
        }
    }

    protected static function create($value, $loose = true)
    {
        return new static($value, $loose);
    }

    public static function strict($value)
    {
        return new static($value, false);
    }
    
    /**
     * Use for creating unusual emails
     */
    public static function loose($value)
    {
        return new static($value, true);
    }

    public function get()
    {
        return $this->email;
    }

    public function __toString()
    {
        return $this->get();
    }
}