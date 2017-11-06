<?php

namespace Endeavors\Support\VO\Tests;

use Endeavors\Support\VO\ModernString;

class ExplodeTest extends \Orchestra\Testbench\TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testExplodeOfImplodedModernArray()
    {
        $modernString = ModernString::create("otp, personMeta:{firstName, lastName, ssn4, dob, address:{fake town, streets:{1234 lane, 5678 lane}}}");

        $result = $modernString->explode();
    }
}