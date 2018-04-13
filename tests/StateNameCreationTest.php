<?php

namespace Endeavors\Support\VO\Tests;

use Endeavors\Support\VO\Geography\US\StateName;

class StateNameCreationTest extends \Orchestra\Testbench\TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * @expectedException Endeavors\Support\VO\Geography\US\Exception\InvalidStateName
     */
    public function testCreatingInvalidStateName()
    {
        StateName::create("abcd");
    }

    /**
     * @expectedException Endeavors\Support\VO\Exceptions\InvalidString
     */
    public function testCreatingStateNameWithBadDataType()
    {
        StateName::create([]);
    }

    public function testCreatingValidStateName()
    {
        StateName::create("Montana");
    }

    public function testCreatingStateNameFromStateCode()
    {
        $name = StateName::fromCode("AZ");

        $this->assertEquals($name, "ARIZONA");

        $this->assertEquals($name->get(), "ARIZONA");
    }
}
