<?php

use \Fzaffa\Validator\Validator;


class ValidatorTest extends PHPUnit_Framework_TestCase {




    public function testValidateRequired()
    {
        $rules = [
            "username" => "required"
        ];

        $validator = new Validator($rules, ["username" => "Fzaffa"]);
        $this->assertTrue($validator->passes());

        $validator = new Validator($rules, ["username" => ""]);
        $this->assertFalse($validator->passes());

    }

    public function testValidateMin()
    {
        $rules = [
            "username" => "min:5"
        ];

        $validator = new Validator($rules, ["username" => "Fzaffa"]);
        $this->assertTrue($validator->passes());

        $validator = new Validator($rules, ["username" => "Fza"]);
        $this->assertFalse($validator->passes());
    }

    public function testValidateMax()
    {
        $rules = [
            "username" => "max:5"
        ];

        $validator = new Validator($rules, ["username" => "Fzaff"]);
        $this->assertTrue($validator->passes());

        $validator = new Validator($rules, ["username" => "Fzaffa"]);
        $this->assertFalse($validator->passes());
    }
    public function testValidateEmail()
    {
        $rules = [
            "email" => "email"
        ];

        $validator = new Validator($rules, ["email" => "test@email.com"]);
        $this->assertTrue($validator->passes());

        $validator = new Validator($rules, ["email" => "testemailcom"]);
        $this->assertFalse($validator->passes());

        $validator = new Validator($rules, ["email" => "testemail.com"]);
        $this->assertFalse($validator->passes());

        $validator = new Validator($rules, ["email" => "test@emailcom"]);
        $this->assertFalse($validator->passes());
    }
    public function testValidateAlphanum()
    {
        $rules = [
            "username" => "alphanum"
        ];

        $validator = new Validator($rules, ["username" => "Hola123"]);
        $this->assertTrue($validator->passes());

        $validator = new Validator($rules, ["username" => "Hola"]);
        $this->assertTrue($validator->passes());

        $validator = new Validator($rules, ["username" => "123"]);
        $this->assertTrue($validator->passes());

        $validator = new Validator($rules, ["username" => "!£$"]);
        $this->assertFalse($validator->passes());

    }
    public function testValidateNumeric()
    {
        $rules = [
            "age" => "numeric"
        ];

        $validator = new Validator($rules, ["age" => "18"]);
        $this->assertTrue($validator->passes());

        $validator = new Validator($rules, ["age" => "!£$"]);
        $this->assertFalse($validator->passes());

        $validator = new Validator($rules, ["age" => "abc"]);
        $this->assertFalse($validator->passes());

        $validator = new Validator($rules, ["age" => "abc123"]);
        $this->assertFalse($validator->passes());
    }

} 