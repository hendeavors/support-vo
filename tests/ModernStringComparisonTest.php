<?php

namespace Endeavors\Support\VO\Tests;

use Endeavors\Support\VO\ModernString;

class ModernStringComparisonTest extends \Orchestra\Testbench\TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testComparisonOfValidString()
    {
        $modernString = ModernString::create("ipv6");

        $this->assertEquals("ipv6", $modernString);

        $this->assertEquals("ipv6", $modernString->get());

        $this->assertEquals($modernString->get(), $modernString);
    }
}