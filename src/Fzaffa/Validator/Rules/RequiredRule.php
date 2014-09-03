<?php

namespace Fzaffa\Validator\Rules;

use Fzaffa\Validator\ValidatorRule;

class RequiredRule implements ValidatorRule {

    public $error;

    public function check($data, $attribute)
    {
        if(isset($data) && $data != '')
        {
            return true;
        }
        $this->error = $attribute." è richiesto";
    }
}