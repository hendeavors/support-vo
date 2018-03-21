<?php

namespace Endeavors\Support\VO\Tests;

use Endeavors\Support\VO\Currency\Money;
use Endeavors\Support\VO\Currency\CommonMoney;
use Endeavors\Support\VO\Currency\SmallMoney;
use Endeavors\Support\VO\Currency\Translator;
use Endeavors\Support\VO\Currency\CurrencyCodeAlpha;

class DollarCreationTest extends \Orchestra\Testbench\TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testProperDollarCurrency()
    {
        $dollars = Money::fromDollars(5.65);

        $this->assertEquals($dollars, "\x24" . 5.65);

        $dollars = Money::fromDollars(5.651);

        $this->assertEquals($dollars, "\x24" . 5.65);

        $dollars = Money::fromDollars(5.655);

        $this->assertEquals($dollars, "\x24" . 5.66);
    }

    public function testProperSmallDollarCurrency()
    {
        $dollars = SmallMoney::fromDollars(5.65);

        $this->assertEquals($dollars, "\x24" . 5.65);

        $dollars = SmallMoney::fromDollars(5.651);

        $this->assertEquals($dollars, "\x24" . 5.65);

        $dollars = SmallMoney::fromDollars(5.655);

        $this->assertEquals($dollars, "\x24" . 5.66);

        $dollars = SmallMoney::from(5.655, Translator::fromCode(CurrencyCodeAlpha::USD()));

        $this->assertEquals($dollars, "\x24" . 5.66);
    }

    public function testProperCommonDollarCurrency()
    {
        $dollars = CommonMoney::fromDollars(5.651);

        $this->assertEquals($dollars, "\x24" . 5.651);

        $dollars = CommonMoney::fromDollars(5.655);

        $this->assertEquals($dollars, "\x24" . 5.655);

        $dollars = CommonMoney::fromDollars(5.6554);

        $this->assertEquals($dollars, "\x24" . 5.6554);

        $dollars = CommonMoney::fromDollars(5.65567);

        $this->assertEquals($dollars, "\x24" . 5.6557);
    }

    public function testNativeValueIsAFloat()
    {
        $dollars = CommonMoney::fromDollars(5.651);

        $this->assertEquals(5.651, $dollars->toNative());

        $this->assertInternalType('float', $dollars->toNative());

        $dollars = SmallMoney::fromDollars(5.651);

        $this->assertEquals(5.65, $dollars->toNative());

        $this->assertInternalType('float', $dollars->toNative());
    }
}
