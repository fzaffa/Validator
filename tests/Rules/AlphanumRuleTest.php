<?php

use Fzaffa\Validator\Rules\AlphanumRule;

class AlphanumRuleTest extends PHPUnit_Framework_TestCase{

    protected  $rule;

    protected  function setUp()
    {
        $this->rule = new AlphanumRule('input');
    }

    public function testAlphanumSuccessWithAlphanumInput()
    {
        $this->assertTrue($this->rule->check("abc123"));
    }

    public function testAlphanumSuccessWithAlphaInput()
    {
        $this->assertTrue($this->rule->check("abc"));
    }

    public function testAlphanumSuccessWithNumInput()
    {
        $this->assertTrue($this->rule->check("123"));
    }

    public function testAlphanumFailsWithSymbols()
    {
        $this->assertFalse($this->rule->check("abc£123"));
    }

    public function testAlphanumFailsWithWhiteSpace()
    {
        $this->assertFalse($this->rule->check("abc 123"));
    }
}