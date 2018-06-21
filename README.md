# PHP Value Objects [![Build Status](https://travis-ci.org/hendeavors/support-vo.svg?branch=2.3)](https://travis-ci.org/hendeavors/support-vo)

A library designed to take an object oriented approach when working with primitive types in php.

# Usage

Using this package is fairly straightforward. Simply create the value object and you are ready to go. Most of the value objects offer a factory creation:

```php

SomeClass::create('somevalue');

```

The value used when creating the value object will be validated. An Email Address:

```php
use Endeavors\Support\VO\EmailAddress;

// is valid
EmailAddress::create('bob@email.com');

// will throw an exception
EmailAddress::create('somevalue');

```

A day value object will also be validated:

```php
use Endeavors\Support\VO\Time\Day;

// is valid
Day::fromSeconds(60 * 60 * 24);

// will throw an exception
Day::fromSeconds("an invalid second");

```

# to-do
1. Support more built-in string functions e.g. trim, rtrim
2. Support specific objects other than email such as phone, state, or country
3. Determine performance of position method in ModernString
4. Add more comprehensive documentation
