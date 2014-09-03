<?php

namespace Fzaffa\Validator\Rules;

class MinRule extends AbstractRule{

    public function check($data)
    {
        if (strlen($data) >= (int)$this->parameter)
        {
            return true;
        }
        $this->error = $this->attribute. " deve essere minimo ".$this->parameter. " caratteri.";
    }
}