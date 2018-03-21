<?php

namespace Endeavors\Support\VO\Tests;

use Endeavors\Support\VO\Currency\Money;
use Endeavors\Support\VO\Currency\CommonMoney;
use Endeavors\Support\VO\Currency\SmallMoney;

class PoundsCreationTest extends \Orchestra\Testbench\TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testProperPoundCurrency()
    {
        $pounds = Money::fromPounds(5.65);

        $this->assertEquals($pounds, "\xa3" . 5.65);
    }
}
