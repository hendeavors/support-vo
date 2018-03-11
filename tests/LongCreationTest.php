<?php

namespace Endeavors\Support\VO\Tests;

use Endeavors\Support\VO\Scalar\Integer\Long;

class LongCreationTest extends \Orchestra\Testbench\TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * @expectedException Endeavors\Support\VO\Exceptions\InvalidNumber
     */
    public function testCreatingInvalidLongInteger()
    {
        $longInteger = Long::create("abcd");
    }

    /**
     * @expectedException Endeavors\Support\VO\Exceptions\InvalidNumber
     */
    public function testCreatingLongIntegerWithBadDataType()
    {
        $longInteger = Long::create([]);
    }

    /**
     * @expectedException Endeavors\Support\VO\Exceptions\InvalidLong
     */
    public function testCreatingNativeLongIntegerHigherThanMaximum()
    {
        // more than the upper limit
        Long::native('9223372036854775808');
    }

    /**
     * @expectedException Endeavors\Support\VO\Exceptions\InvalidLong
     */
    public function testCreatingNativeLongIntegerLowerThanMinimum()
    {
        // less than the lower limit
        Long::native('-9223372036854775809');
    }

    public function testCreatingValidLongIntegerNatively()
    {
        $longInteger = Long::native(123);
    }

    public function testCreatingValidLongIntegerAsNumericalString()
    {
        $longInteger = Long::create('123');
    }

    public function testCreatingProperLongIntegerValuesNatively()
    {
        // a normal integer
        Long::native(123);
        // the lower limit
        $min = Long::native('-9223372036854775808');

        $this->assertEquals($min, '-9223372036854775808');
        $this->assertTrue(is_int($min->get()));
        // the upper limit
        $max = Long::native('9223372036854775807');

        $this->assertEquals($max, '9223372036854775807');
        $this->assertTrue(is_int($max->get()));
    }
}
