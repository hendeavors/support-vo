<?php

namespace Endeavors\Support\VO\Tests;

use Endeavors\Support\VO\Time;
use Endeavors\Support\VO\Scalar;

class MonthConversionTest extends \Orchestra\Testbench\TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testMonthToDaysFromTodaysDate()
    {
        $m = Time\Month::create('Y-03-d');

        $this->assertEquals($m, date("F"));

        $days = Scalar\IntegerImplementation::create($m->toDays());

        $this->assertEquals("31", $days);
    }

    public function testMonthToDaysFromFixedDate()
    {
        $m = Time\Month::create('2010-01-31');

        $this->assertEquals($m, "January");

        $days = Scalar\IntegerImplementation::create($m->toDays());

        $this->assertEquals(date('31'), $days);
    }

    public function testNextMonthFromFixedDate()
    {
        // create our first date
        //
        $m = Time\Month::create('2010-01-31');

        $this->assertEquals($m->nextMonth(), "February");

        $days = Scalar\IntegerImplementation::create($m->nextMonth()->toDays());

        $this->assertEquals(date('28'), $days);

        // create a new date

        $m = Time\Month::create('2010-01-05');

        $this->assertEquals($m->nextMonth(), "February");

        $days = Scalar\IntegerImplementation::create($m->nextMonth()->toDays());

        $this->assertEquals($m->nextMonth()->toDateTime(), new \DateTime("2010-02-05"));

        $this->assertEquals(date('28'), $days);

        // create a new date

        $m = Time\Month::create('2010-05-15');

        $this->assertEquals($m->nextMonth(), "June");

        $days = Scalar\IntegerImplementation::create($m->nextMonth()->toDays());

        $this->assertEquals($m->nextMonth()->toDateTime(), new \DateTime("2010-06-15"));

        $this->assertEquals(date('30'), $days);

        // create a new date

        $m = Time\Month::create('2010-05-31');

        $this->assertEquals($m->nextMonth(), "June");

        $days = Scalar\IntegerImplementation::create($m->nextMonth()->toDays());

        $this->assertEquals($m->nextMonth()->toDateTime(), new \DateTime("2010-06-30"));

        $this->assertEquals(date('30'), $days);
    }

    public function testNextMonthFromFixedDateWithoutYear()
    {
        // todo
    }

    public function testRepeatedNextMonth()
    {
        $m = Time\Month::create('2010-01-31');

        $this->assertEquals($m->nextMonth()->nextMonth()->nextMonth(), "April");
    }
}
