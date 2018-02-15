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
    public function testCreatingInvalidStateCode()
    {
        $modernString = StateName::create("abcd");
    }

    /**
     * @expectedException Endeavors\Support\VO\Exceptions\InvalidString
     */
    public function testCreatingStateNameWithBadDataType()
    {
        $modernString = StateName::create([]);
    }

    public function testCreatingValidStateCode()
    {
        $modernString = StateName::create("Montana");
    }
}
