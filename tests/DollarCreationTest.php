<?php

namespace Endeavors\Support\VO\Tests;

use Endeavors\Support\VO\Currency\Money;

class DollarCreationTest extends \Orchestra\Testbench\TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testProperDollarCurrency()
    {
        $dollars = Money::fromDollars(5.65);

        dd($dollars);
    }
}
