<?php

namespace Endeavors\Support\VO\Tests;

use Endeavors\Support\VO\Time;
use Endeavors\Support\VO\Scalar;

class HourConversionTest extends \Orchestra\Testbench\TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testConversionFromHourValue()
    {
        $h = Time\Hour::fromDays(3);

        $secondsValue = 3 * 24 * 60 * 60;

        $this->assertEquals($h->toSeconds(), $secondsValue);
    }

    public function testConversionFromSecondsValue()
    {
        $h = Time\Hour::fromSeconds(35);

        $secondsValue = 0;

        $this->assertEquals($h->toSeconds(), $secondsValue);

        $h = Time\Hour::fromSeconds(3600);

        $secondsValue = 3600;

        $this->assertEquals($h->toSeconds(), $secondsValue);

        $h = Time\Hour::fromSeconds(3601);

        $secondsValue = 3600;

        $this->assertEquals($h->toSeconds(), $secondsValue);

        $h = Time\Hour::fromSeconds(7202);

        $secondsValue = 7200;

        $this->assertEquals($h->toSeconds(), $secondsValue);
    }
}
