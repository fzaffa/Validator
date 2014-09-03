<?php

use Fzaffa\Validator\Rules\EmailRule;

class EmailRuleTest extends PHPUnit_Framework_TestCase {

    protected $rule;

    protected function setUp()
    {
        $this->rule = new EmailRule('email');
    }

    public function testEmailSuccessWithCorrectEmail()
    {
        $this->assertTrue($this->rule->check("correct@email.com"));
    }

    public function testEmailFailsWithoutAtSymbol()
    {
        $this->assertNull($this->rule->check("correctemail.com"));
    }

    public function testEmailFailsWithoutDomainSuffix()
    {
        $this->assertNull($this->rule->check("correct@emailcom"));
    }
}
 