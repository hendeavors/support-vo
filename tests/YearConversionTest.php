<?php

namespace Endeavors\Support\VO\Tests;

use Endeavors\Support\VO\Time;
use Endeavors\Support\VO\Scalar;

class YearConversionTest extends \Orchestra\Testbench\TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testConversionFromWeekValue()
    {
        // 52 * 7 = 364 days
        $y = Time\Year::fromWeeks(105);

        $this->assertEquals($y->get(), 2);
    }

    public function testConversionFromDayValue()
    {
        $y = Time\Year::fromDays(Time\Year::guessUnit());

        $this->assertEquals($y->get(), 1);
    }

    public function testConversionFromHourValue()
    {
        $y = Time\Year::fromHours(Time\Year::guessUnit() * 24);

        $this->assertEquals($y->get(), 1);
    }

    public function testConversionFromHourValueToDays()
    {
        $y = Time\Year::fromHours(Time\Year::guessUnit() * 24);

        $this->assertEquals($y->toDays(), Time\Year::guessUnit());
    }

    public function testConversionFromHourValueToHours()
    {
        $y = Time\Year::fromHours(Time\Year::guessUnit() * 24);

        $this->assertEquals($y->toHours(), Time\Year::guessUnit() * 24);
    }

    public function testConversionFromHourValueToMinutes()
    {
        $y = Time\Year::fromHours(Time\Year::guessUnit() * 24);

        $this->assertEquals($y->toMinutes(), Time\Year::guessUnit() * 24 * 60);
    }

    public function testConversionFromSecondsValue()
    {
        $y = Time\Year::fromSeconds(35);

        $secondsValue = 0;

        $this->assertEquals($y->toSeconds(), $secondsValue);

        $y = Time\Year::fromSeconds(24 * 60 * 60 * Time\Year::guessUnit());

        $secondsValue = 24 * 60 * 60 * Time\Year::guessUnit();

        $this->assertEquals($y->toSeconds(), $secondsValue);

        $this->assertEquals($y->get(), 1);
    }
}
