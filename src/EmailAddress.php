<?php

namespace Endeavors\Support\VO;

/**
 * Represent a valid email address
 */
class EmailAddress
{
    /**
     * The email string to be created as a value object
     * 
     * @var string
     */
    protected $email;
    
    /**
     * Create the email
     * We default to a syntactically valid email
     * 
     * @param string email
     * @param bool loose
     */
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

    public function get()
    {
        return $this->email;
    }

    public function __toString()
    {
        return $this->get();
    }
}