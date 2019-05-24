<?php

namespace Endeavors\Support\VO\Currency;

trait DollarConversion
{
    public function toPennies()
    {
        return $this->toCents();
    }

    public function toCents()
    {
        return $this->value * 100;
    }

    public function toMicrons()
    {
        return $this->value * 1000000;
    }

    public function toNickels()
    {
        return (int)($this->value * 20);
    }

    public function toDimes()
    {
        return (int)($this->value * 10);
    }

    public function toQuarters()
    {
        return (int)($this->value * 4);
    }

    public function inPennies()
    {
        return $this->toPennies();
    }

    public function inCents()
    {
        return $this->toPennies();
    }

    public function inNickels()
    {
        return $this->toNickels();
    }

    public function inDimes(): int
    {
        return $this->toDimes();
    }

    public function inQuarters(): int
    {
        return $this->toQuarters();
    }

    public function inMicrons(): int
    {
        return $this->toMicrons();
    }
}
