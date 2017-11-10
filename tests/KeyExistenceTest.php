<?php

namespace Endeavors\Support\VO\Tests;

use Endeavors\Support\VO\ModernArray;

class KeyExistenceTest extends \Orchestra\Testbench\TestCase
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

        $this->assertTrue($modernArray->hasKey(1));

        $this->assertFalse($modernArray->hasKey("four"));
    }
}