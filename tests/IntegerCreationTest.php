<?php

namespace Endeavors\Support\VO\Tests;

use Endeavors\Support\VO\Scalar\IntegerImplementation;

class IntegerCreationTest extends \Orchestra\Testbench\TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * @expectedException Endeavors\Support\VO\Exceptions\InvalidNumber
     */
    public function testCreatingInvalidInteger()
    {
        IntegerImplementation::create("abcd");
    }

    /**
     * @expectedException Endeavors\Support\VO\Exceptions\InvalidNumber
     */
    public function testCreatingIntegerWithBadDataType()
    {
        IntegerImplementation::create([]);
    }

    public function testCreatingIntegerAsHexadecimal()
    {
        $integer = IntegerImplementation::create(0xffff);

        $this->assertEquals($integer, "65535");

        $this->assertEquals($integer->toNative(), 65535);
    }
}
