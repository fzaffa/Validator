<?php


use Fzaffa\Validator\Rules\MaxRule;

class MaxRuleTest extends PHPUnit_Framework_TestCase {

    protected $rule;

    protected function setUp()
    {
        $this->rule = new MaxRule('input', 3);
    }

    public function testMaxSuccessWithCorrectInput()
    {
        $this->assertTrue($this->rule->check("abc"));
    }

    public function testMaxFailsWithWrongInput()
    {
        $this->assertNull($this->rule->check("abcders"));
    }
}
 