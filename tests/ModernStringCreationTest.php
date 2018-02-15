<?php

namespace Endeavors\Support\VO\Tests;

use Endeavors\Support\VO\ModernString;

class ModernStringCreationTest extends \Orchestra\Testbench\TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * @expectedException Endeavors\Support\VO\Exceptions\InvalidString
     */
    public function testCreatingInvalidString()
    {
        $modernString = ModernString::create([]);
    }

    public function testCreatingValidString()
    {
        $modernString = ModernString::create("some valid string");
    }

    /**
     * @expectedException Endeavors\Support\VO\Exceptions\InvalidString
     */
    public function testCreatingNullString()
    {
        $modernString = ModernString::create(null);
    }
}
