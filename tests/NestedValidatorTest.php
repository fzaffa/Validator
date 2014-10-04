<?php

use \Fzaffa\Validator\Validator;

class NestedValidatorTest extends PHPUnit_Framework_TestCase {

    public function testValidationPassesWithCorrectInputAndRules()
    {
        $rules = [
            'links' => [
                'url' => 'required',
                'title' => 'required|alphanum'
            ]
        ];

        $input = [
            'links' => [
                [
                    'url' => 'www.google.com',
                    'title' => 'Google'
                ],
                [
                'url' => 'www.facebook.com',
                'title' => 'Facebook'
                ]
            ]
        ];
        $validator = new Validator($rules, $input);
        $this->assertTrue($validator->passes());
    }
    public function testValidationFailsWithWrongInputAndRules()
    {
        $rules = [
            'links' => [
                'url' => 'required',
                'title' => 'required|alphanum'
            ]
        ];

        $input = [
            'links' => [
                [
                    'url' => '',
                    'title' => 'Google'
                ],
                [
                    'url' => 'www.facebook.com',
                    'title' => 'Facebook'
                ]
            ]
        ];
        $validator = new Validator($rules, $input);
        $this->assertFalse($validator->passes());
    }
}
 