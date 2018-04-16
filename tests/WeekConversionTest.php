<?php

namespace Endeavors\Support\VO\Tests;

use Endeavors\Support\VO\Time;
use Endeavors\Support\VO\Scalar;

class WeekConversionTest extends \Orchestra\Testbench\TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testConversionFromWeekValue()
    {
        $w = Time\Week::fromDays(7);

        $secondsValue = 7 * 24 * 60 * 60;

        $this->assertEquals($w->toSeconds(), $secondsValue);
    }

    public function testConversionFromSecondsValue()
    {
        $w = Time\Week::fromSeconds(35);

        $secondsValue = 0;

        $this->assertEquals($w->toSeconds(), $secondsValue);

        $w = Time\Week::fromSeconds(604800);

        $secondsValue = 604800;

        $this->assertEquals($w->toSeconds(), $secondsValue);

        $this->assertEquals($w->get(), 1);
    }
}
