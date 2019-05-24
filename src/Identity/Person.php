<?php

namespace Endeavors\Support\VO\Identity;

class Person
{
    private $firstname;

    private $lastname;

    public function __construct(Firstname $firstname, Lastname $lastname)
    {
        $this->firstname = $firstname;

        $this->lastname = $lastname;
    }
}
