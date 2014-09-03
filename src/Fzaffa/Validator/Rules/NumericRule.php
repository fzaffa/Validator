<?php

namespace Fzaffa\Validator\Rules;

class NumericRule extends AbstractRule{

    public function check($data)
    {
        if(is_numeric($data))
        {
            return true;
        }
        $this->error = $this->attribute." non è numerico";
    }
} 