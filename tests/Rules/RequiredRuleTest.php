<?php

use Fzaffa\Validator\Rules\RequiredRule;

class RequiredRuleTest extends PHPUnit_Framework_TestCase {

    protected $rule;

    protected function setUp()
    {
        $this->rule = new RequiredRule('input');
    }

    public function testRequiredSuccessWithInput()
    {
        $this->assertTrue($this->rule->check("fzaffa"));
    }

    public function testRequiredFailsWithEmptyInput()
    {
        $this->assertNull($this->rule->check(""));
    }
}