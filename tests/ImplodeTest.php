<?php

namespace Endeavors\Support\VO\Tests;

use Endeavors\Support\VO\ModernArray;

class ImplodeTest extends \Orchestra\Testbench\TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testImplodeOfArray()
    {
        $someArray = [
            'firstName',
            'lastName',
            'ssn4',
            'dob'
        ];

        $modernArray = ModernArray::create($someArray);

        $this->assertEquals('firstName, lastName, ssn4, dob', $modernArray->implode());
    }

    public function testImplodeOfObject()
    {
        $someObject = (object)[
            'firstName',
            'lastName',
            'ssn4',
            'dob'
        ];

        $modernArray = ModernArray::create($someObject);

        $this->assertEquals('firstName, lastName, ssn4, dob', $modernArray->implode());
    }
}