<?php

namespace Endeavors\Support\VO\Tests;

use Endeavors\Support\VO\ModernArray;

class InArrayTest extends \Orchestra\Testbench\TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testInArray()
    {
        $modernArray = ModernArray::create([
            'one',
            'two',
            'three'
        ]);

        $this->assertTrue($modernArray->inArray("one"));

        $this->assertFalse($modernArray->inArray("four"));
    }
}