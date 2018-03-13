<?php

namespace Endeavors\Support\VO\Platform;

class Architecture
{
    const INTEGER_MAX = 2147483647;

    public static function isNotModern()
    {
        return ! static::isModern();
    }

    public static function isModern()
    {
        return static::is64Bit();
    }

    public static function is64Bit()
    {
        return PHP_INT_MAX > static::INTEGER_MAX;
    }
}
