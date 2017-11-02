<?php

namespace Endeavors\Support\VO\Tests;

use Endeavors\Support\VO\ModernArray;

/**
 * The intent here is to prove the capabilities of casting to an array
 */
class FactoryTest extends \Orchestra\Testbench\TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testCreatingModernArrayFromEmptyClass()
    {
        $modernArray = ModernArray::create(new TestEmptyClass());

        $this->assertEquals("", sprintf($modernArray));
    }

    public function testCreatingModernArrayFromClassWithProperties()
    {
        $modernArray = ModernArray::create(new TestPropertyClass());

        $this->assertEquals("p1,p2", sprintf($modernArray));
    }

    public function testCreatingModernArrayFromClass()
    {
        $modernArray = ModernArray::create(new TestMethodPropertyClass());

        $this->assertEquals("p1,p2", sprintf($modernArray));        
    }
}

class TestEmptyClass{}

class TestPropertyClass{
    protected $p1 = "p1";

    public $p2 = "p2";
}

class TestMethodPropertyClass extends TestPropertyClass{
    public function foo()
    {
        return "foo";
    }

    protected function bar()
    {
        return "bar";
    }
}