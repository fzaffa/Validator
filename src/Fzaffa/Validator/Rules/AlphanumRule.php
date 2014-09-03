<?php

namespace Fzaffa\Validator\Rules;

use Fzaffa\Validator\ValidatorRule;

class AlphanumRule implements ValidatorRule{

    public $error;

    public function check($data, $attribute)
    {
        if(ctype_alnum($data))
        {
            return true;
        }
        $this->error = $attribute." deve essere alfanumerico";
    }
}