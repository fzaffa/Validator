<?php

use Fzaffa\Validator\Rules\MinRule;

class MinRuleTest extends PHPUnit_Framework_TestCase{

    protected  $rule;

    protected  function setUp()
    {
        $this->rule = new MinRule('input', 3);
    }

    public function testMinSuccessWithCorrectInput()
    {
        $this->assertTrue($this->rule->check("abcd"));
    }

    public function testAlphanumFailsWithWrongInput()
    {
        $this->assertNull($this->rule->check("ab"));
    }
}