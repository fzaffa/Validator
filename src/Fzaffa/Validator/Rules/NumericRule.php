<?php

namespace Fzaffa\Validator\Rules;


use Fzaffa\Validator\ValidatorRule;

class NumericRule implements ValidatorRule{
    public $error;

    public function check($data, $attribute)
    {
        if(is_numeric($data))
        {
            return true;
        }
        $this->error = $attribute." non è numerico";
    }
} 