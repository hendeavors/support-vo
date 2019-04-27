<?php

namespace Endeavors\Support\VO\Identity;

use Endeavors\Support\VO\Scalar\SystemString;
use Endeavors\Support\VO\ModernString;

class Firstname extends SystemString
{
    protected function __construct(string $firstname)
    {
        $this->value = ModernString::create($firstname;
    }
}
