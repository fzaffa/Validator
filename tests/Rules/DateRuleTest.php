<?php

use Fzaffa\Validator\Rules\DateRule;

class dateRuleTest extends PHPUnit_Framework_TestCase {
    protected $rule;

    protected function setUp()
    {
        $this->rule = new DateRule('2014-12-11', 'Y-m-d');
    }

    public function testValidDate()
    {
        $this->assertTrue($this->rule->check('2012-11-11'));
    }

    public function testInvalidValidDate()
    {
        $this->assertFalse($this->rule->check('201s2-11-11'));
    }
}
 