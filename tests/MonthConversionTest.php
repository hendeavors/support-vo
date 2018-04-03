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

        $m = Time\Month::create('2010-01-31')->next();

        $this->assertEquals($m, "February");

        $days = Scalar\IntegerImplementation::create($m->toDays());

        $this->assertEquals(date('28'), $days);

        // create a new date

        $m = Time\Month::create('2010-01-05')->next();

        $this->assertEquals($m, "February");

        $days = Scalar\IntegerImplementation::create($m->toDays());

        $this->assertEquals($m->toDateTime(), new \DateTime("2010-02-05"));

        $this->assertEquals(date('28'), $days);

        // create a new date

        $m = Time\Month::create('2010-05-15')->next();

        $this->assertEquals($m, "June");

        $days = Scalar\IntegerImplementation::create($m->toDays());

        $this->assertEquals($m->toDateTime(), new \DateTime("2010-06-15"));

        $this->assertEquals(date('30'), $days);

        // create a new date

        $m = Time\Month::create('2010-05-31')->next();

        $this->assertEquals($m, "June");

        $days = Scalar\IntegerImplementation::create($m->toDays());

        $this->assertEquals($m->toDateTime(), new \DateTime("2010-06-30"));

        $this->assertEquals(date('30'), $days);
    }

    public function testPreviousMonthFromFixedDate()
    {
        // create our first date

        $m = Time\Month::create('2010-02-28')->previous();

        $this->assertEquals($m, "January");

        $days = Scalar\IntegerImplementation::create($m->toDays());

        $this->assertEquals(date('31'), $days);

        // create a new date

        $m = Time\Month::create('2010-01-05')->previous();

        $this->assertEquals($m, "December");

        $days = Scalar\IntegerImplementation::create($m->toDays());

        $this->assertEquals($m->toDateTime(), new \DateTime("2009-12-05"));

        $this->assertEquals(date('31'), $days);

        // create a new date

        $m = Time\Month::create('2010-05-15')->previous();

        $this->assertEquals($m, "April");

        $days = Scalar\IntegerImplementation::create($m->toDays());

        $this->assertEquals($m->toDateTime(), new \DateTime("2010-04-15"));

        $this->assertEquals(date('30'), $days);

        // create a new date

        $m = Time\Month::create('2010-05-31')->previous();

        $this->assertEquals($m, "April");

        $days = Scalar\IntegerImplementation::create($m->toDays());

        $this->assertEquals($m->toDateTime(), new \DateTime("2010-04-30"));

        $this->assertEquals(date('30'), $days);
    }

    public function testNextMonthFromFixedDateWithoutYear()
    {
        // todo
    }

    public function testChainedRepeatedCallToNextMonth()
    {
        $m = Time\Month::create('2010-01-31');

        $this->assertEquals($m->next()->next()->next(), "April");
    }

    public function testSeparatedRepeatedCallToNextMonth()
    {
        $m = Time\Month::create('2010-01-31');

        $m->next();

        $m->next();

        $m->next();

        $this->assertEquals($m, "April");
    }

    public function testChainedRepeatedCallToPreviousMonth()
    {
        $m = Time\Month::create('2010-07-31');

        $this->assertEquals($m->previous()->previous()->previous(), "April");

        $m = Time\Month::create('2010-07-04');

        $this->assertEquals($m->previous()->previous()->previous(), "April");

        $this->assertEquals($m->toDateTime(), new \DateTime("2010-04-04"));
    }

    public function testSeparatedRepeatedCallToPreviousMonth()
    {
        $m = Time\Month::create('2010-07-31');

        $m->previous();

        $m->previous();

        $m->previous();

        $this->assertEquals($m, "April");

        $m = Time\Month::create('2010-07-04');

        $m->previous();

        $m->previous();

        $m->previous();

        $this->assertEquals($m, "April");

        $this->assertEquals($m->toDateTime(), new \DateTime("2010-04-04"));
    }
}
