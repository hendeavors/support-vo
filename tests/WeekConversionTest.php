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

    public function testConversionFromMinutesValue()
    {
        $w = Time\Week::fromMinutes(7 * 24 * 60);

        $this->assertEquals($w->get(), 1);

        // three weeks

        $w = Time\Week::fromMinutes(7 * 3 * 24 * 60);

        $this->assertEquals($w->get(), 3);
    }

    public function testConversionFromHoursValue()
    {
        $w = Time\Week::fromHours(7 * 24);

        $this->assertEquals($w->get(), 1);

        // two weeks

        $w = Time\Week::fromHours(7 * 2 * 24);

        $this->assertEquals($w->get(), 2);
    }

    public function testConversionToDaysValue()
    {
        $w = Time\Week::create(1);

        $this->assertEquals($w->toDays(), 7);

        $w = Time\Week::create(4);

        $this->assertEquals($w->toDays(), 7 * 4);
    }

    public function testConversionToHoursValue()
    {
        $w = Time\Week::create(1);

        $this->assertEquals($w->toHours(), 7 * 24);

        $w = Time\Week::create(4);

        $this->assertEquals($w->toHours(), 7 * 24 * 4);
    }

    public function testConversionToMinutesValue()
    {
        $w = Time\Week::create(1);

        $this->assertEquals($w->toMinutes(), 7 * 24 * 60);
    }

    public function testConversionToSecondsValue()
    {
        $w = Time\Week::create(1);

        $this->assertEquals($w->toSeconds(), 7 * 24 * 60 * 60);

        $w = Time\Week::create(7);

        $this->assertEquals($w->toSeconds(), 7 * 24 * 60 * 60 * 7);
    }

    public function testConversionFromSecondsValue()
    {
        $w = Time\Week::fromSeconds(35);

        $this->assertEquals($w->get(), 0);

        $w = Time\Week::fromSeconds(604800);

        $this->assertEquals($w->get(), 1);
    }
}
