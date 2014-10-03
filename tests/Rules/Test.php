<?php


use Fzaffa\Validator\Rules\NumericRule;

class NumericRuleTest extends PHPUnit_Framework_TestCase {

    protected $rule;

    protected function setUp()
    {
        $this->rule = new NumericRule('input');
    }

    public function testNumericSuccessWithCorrectInput()
    {
        $this->assertTrue($this->rule->check("1234"));
    }

    public function testNumericFailsWithWrongInput()
    {
        $this->assertFalse($this->rule->check("abcd"));
    }
}
 