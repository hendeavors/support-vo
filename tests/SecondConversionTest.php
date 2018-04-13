<?php

namespace Endeavors\Support\VO\Tests;

use Endeavors\Support\VO\Time;
use Endeavors\Support\VO\Scalar;

class SecondConversionTest extends \Orchestra\Testbench\TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testConversionFromMonthValue()
    {
        $m = Time\Month::create('2010-01-31');

        $secondsValue = 31 * 24 * 60 * 60;

        $this->assertEquals($m->toSeconds(), $secondsValue);

        $this->assertEquals($m->toNative(), $secondsValue);

        $m = Time\Month::create('2016-02-29');

        $secondsValue = 29 * 24 * 60 * 60;

        $this->assertEquals($m->toSeconds(), $secondsValue);

        $this->assertEquals($m->toNative(), $secondsValue);
    }
}
