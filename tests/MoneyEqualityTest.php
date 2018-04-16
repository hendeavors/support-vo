<?php

namespace Endeavors\Support\VO\Tests;

use Endeavors\Support\VO\Currency;

class MoneyEqualityTest extends \Orchestra\Testbench\TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testMoneyEquality()
    {
        $m = Currency\Money::fromDollars(4.99);

        $this->assertTrue($m->equals(4.99));

        $m = Currency\Money::fromDollars(4.999);

        $this->assertTrue($m->equals(4.999));

        $m = Currency\Money::fromDollars(0);

        $this->assertTrue($m->equals(0));
    }

    public function testMoneyIdenticalEquality()
    {
        $m = Currency\Money::fromDollars(4.99);

        $this->assertTrue($m->identical(4.99));
    }
}
