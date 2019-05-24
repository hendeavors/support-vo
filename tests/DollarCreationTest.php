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

    /** @test */
    public function convertToPennies()
    {
        $dollars = Money::fromDollars(4);

        $this->assertEquals($dollars->inPennies(), 400);
    }

    /** @test */
    public function convertToQuarters()
    {
        $dollars = Money::fromDollars(4);

        $this->assertEquals($dollars->inQuarters(), 16);

        $dollars = Money::fromDollars(4.18);

        $this->assertEquals($dollars->inQuarters(), 16);

        $dollars = Money::fromDollars(4.52);

        $this->assertEquals($dollars->inQuarters(), 18);

        $dollars = Money::fromDollars(0.25);

        $this->assertEquals($dollars->inQuarters(), 1);

        $dollars = Money::fromDollars(0.2499999999);

        $this->assertEquals($dollars->inQuarters(), 0);
    }

    /** @test */
    public function convertToDimes()
    {
        $dollars = Money::fromDollars(4);

        $this->assertEquals($dollars->inDimes(), 40);

        $dollars = Money::fromDollars(0.2499999999);

        $this->assertEquals($dollars->inDimes(), 2);
    }

    /** @test */
    public function convertToNickels()
    {
        $dollars = Money::fromDollars(4);

        $this->assertEquals($dollars->inNickels(), 80);

        $dollars = Money::fromDollars(4.045);

        $this->assertEquals($dollars->inNickels(), 80);

        $dollars = Money::fromDollars(4.09);

        $this->assertEquals($dollars->inNickels(), 81);
    }

    /** @test */
    public function convertToMicrons()
    {
        $dollars = Money::fromDollars(4);

        $this->assertEquals($dollars->inMicrons(), 4000000);
    }

    /** @test */
    public function addMoney()
    {
        $dollars = Money::fromDollars(4);

        $dollars->add(5.52);

        $this->assertEquals(4, $dollars->toNative());
    }

    /** @test */
    public function addMoneyImmutable()
    {
        $dollars = Money::fromDollars(4);

        $dollars = $dollars->add(5.52);

        $this->assertEquals(9.52, $dollars->toNative());

        $dollars = Money::fromDollars(1.1);

        $dollars = $dollars->add(1.2);

        $this->assertEquals(2.3, $dollars->toNative());

        $dollars = Money::fromDollars(0.1);

        $dollars = $dollars->add(0.2);

        $this->assertEquals(0.3, $dollars->toNative());
    }

    /** @test */
    public function subtractMoney()
    {
        $dollars = Money::fromDollars(4);

        $dollars->subtract(5.52);

        $this->assertEquals(4, $dollars->toNative());
    }

    /** @test */
    public function subtractMoneyImmutable()
    {
        $dollars = Money::fromDollars(4);

        $dollars = $dollars->subtract(5.52);

        $this->assertEquals(-1.52, $dollars->toNative());
    }
}
