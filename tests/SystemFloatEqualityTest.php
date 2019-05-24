<?php

namespace Endeavors\Support\VO\Tests;

use Endeavors\Support\VO\Scalar\Floats;

class SystemFloatEqualityTest extends \Orchestra\Testbench\TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testSystemFloatEquality()
    {
        $fl = Floats\SystemFloat::create(4.99);

        $this->assertTrue($fl->equals(4.99));

        $fl = Floats\SystemFloat::create(0);

        $this->assertTrue($fl->equals(0));
    }

    public function testSystemFloatInequality()
    {
        $fl = Floats\SystemFloat::create(4.89);

        $this->assertFalse($fl->equals(4.79));
    }

    public function testSystemFloatIdenticalEquality()
    {
        $fl = Floats\SystemFloat::create(4.99);

        $this->assertTrue($fl->identical(4.99));
    }

    public function testSystemFloatIdenticalInequality()
    {
        $fl = Floats\SystemFloat::create(4.89);

        $this->assertFalse($fl->identical(4.79));
    }

    /**
     * @expectedException \Endeavors\Support\VO\Exceptions\InvalidNumber
     */
    public function testSystemFloatNullEquality()
    {
        $fl = Floats\SystemFloat::create(4.2);

        $this->assertFalse($fl->equals(null));
    }
}
