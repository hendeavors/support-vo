<?php

namespace Endeavors\Support\VO\Tests;

use Endeavors\Support\VO\EmailAddress;

class EmailAddressComparisonTest extends \Orchestra\Testbench\TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testComparisonOfLooseValidEmail()
    {
        $email = EmailAddress::loose("adam@healthendeavors.com");

        $this->assertEquals("adam@healthendeavors.com", $email);

        $this->assertEquals("adam@healthendeavors.com", $email->get());

        $this->assertEquals( $email->get(), $email);
    }
}
