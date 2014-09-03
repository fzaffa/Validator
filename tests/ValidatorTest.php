<?php

use \Fzaffa\Validator\Validator;


class ValidatorTest extends PHPUnit_Framework_TestCase {

    public function testCorrectRulesInstantiated()
    {
        $validator = new Validator(['user' => 'min:3'], ['user' => 'username']);
        $rules = PHPUnit_Framework_Assert::readAttribute($validator, "rules");
        $this->assertInstanceOf('\\Fzaffa\\Validator\\Rules\\MinRule', $rules['user'][0]);
    }

    public function testExceptionIsThrownIfRuleDoesNotExist()
    {
        $this->setExpectedException('\\Fzaffa\\Validator\\RuleNotFoundException');
        new Validator(['user' => 'testrule'], ['user' => 'username']);
    }

    public function testValidationPassesWithCorrectInputAndRules()
    {
        $validator = new Validator(['user' => 'required'], ['user' => 'username']);
        $this->assertTrue($validator->passes());
    }

    public function testValidationFailsWithWrongInputAndCorrectRules()
    {
        $validator = new Validator(['user' => 'required'], ['user' => '']);
        $this->assertFalse($validator->passes());
    }

}