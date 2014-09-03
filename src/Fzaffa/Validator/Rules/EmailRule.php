<?php

namespace Fzaffa\Validator\Rules;

use Fzaffa\Validator\ValidatorRule;

class EmailRule implements ValidatorRule {

    public $error;

    public function check($data, $attribute)
    {
        if(preg_match('/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}/', $data))
        {
            return true;
        }
        $this->error = $attribute." non è un'email valida";
    }
} 