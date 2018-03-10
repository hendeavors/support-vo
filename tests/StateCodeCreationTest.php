<?php

namespace Endeavors\Support\VO\Tests;

use Endeavors\Support\VO\Geography\US\StateCode;

class StateCodeCreationTest extends \Orchestra\Testbench\TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * @expectedException Endeavors\Support\VO\Geography\US\Exception\InvalidStateCode
     */
    public function testCreatingInvalidStateCode()
    {
        StateCode::create("abcd");
    }

    /**
     * @expectedException Endeavors\Support\VO\Exceptions\InvalidString
     */
    public function testCreatingStateCodeWithBadDataType()
    {
        StateCode::create([]);
    }

    /**
     * @expectedException Endeavors\Support\VO\Geography\US\Exception\InvalidStateCode
     */
    public function testStateCodeCaseSensitivityUpperLower()
    {
        StateCode::create("Az");
    }

    /**
     * @expectedException Endeavors\Support\VO\Geography\US\Exception\InvalidStateCode
     */
    public function testStateCodeCaseSensitivityLowerUpper()
    {
        StateCode::create("aZ");
    }

    /**
     * @expectedException Endeavors\Support\VO\Geography\US\Exception\InvalidStateCode
     */
    public function testStateCodeCaseSensitivityLower()
    {
        StateCode::create("az");
    }

    /**
     * @expectedException Endeavors\Support\VO\Geography\US\Exception\InvalidStateName
     */
    public function testCreatingStateCodeFromInvalidStateName()
    {
        StateCode::fromState("Someinvalidstate");
    }

    public function testCreatingValidStateCode()
    {
        StateCode::create("AZ");
    }

    public function testCreatingStateCodeFromStateName()
    {
        $code = StateCode::fromState("Arizona");

        $this->assertEquals($code, "AZ");

        $this->assertEquals($code->get(), "AZ");

        $this->assertEquals($code, $code->get());
    }
}
