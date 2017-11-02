<?php

namespace Endeavors\Support\VO\Tests;

use Endeavors\Support\VO\ModernArray;

class RecursiveImplodeTest extends \Orchestra\Testbench\TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testImplodeOfArray()
    {
        $someNestedArray = [
            'otp',
            'personMeta' => [
                'firstName',
                'lastName',
                'ssn4',
                'dob'
            ]
        ];

        $modernArray = ModernArray::create($someNestedArray);

        $this->assertEquals('otp, firstName, lastName, ssn4, dob', $modernArray->implode());
    }

    public function testImplodeOfObject()
    {
        $someNestedObject = (object)[
            'otp',
            'personMeta' => [
                'firstName',
                'lastName',
                'ssn4',
                'dob'
            ]
        ];

        $modernArray = ModernArray::create($someNestedObject);

        $this->assertEquals('otp, firstName, lastName, ssn4, dob', $modernArray->implode());
    }

    public function testModernArrayCanBeEchoed()
    {
        $someNestedObject = (object)[
            'otp',
            'personMeta' => [
                'firstName',
                'lastName',
                'ssn4',
                'dob'
            ]
        ];

        $modernArray = ModernArray::create($someNestedObject);

        $this->assertStringMatchesFormat('%s', sprintf($modernArray));
    }
}