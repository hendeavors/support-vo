<?php

namespace Endeavors\Support\VO\Identity;

use Endeavors\Support\VO\Scalar\SystemString;
use Endeavors\Support\VO\ModernString;

class Lastname extends SystemString
{
    protected function __construct(string $lastname)
    {
        $this->value = ModernString::create($lastname);
    }
}
