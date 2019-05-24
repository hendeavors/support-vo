<?php

namespace Endeavors\Support\VO\Tests;

use Endeavors\Support\VO\Identity\Firstname;
use Endeavors\Support\VO\Identity\Lastname;
use Endeavors\Support\VO\Identity\Person;
use Orchestra\Testbench\TestCase;

class PersonCreationTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    /** @test **/
    public function creatingPersonInstance()
    {
        $person = new Person(Firstname::create("bob"), Lastname::create("smith"));
    }
}
