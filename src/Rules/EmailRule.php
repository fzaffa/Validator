<?php

namespace Fzaffa\Validator\Rules;

class EmailRule extends AbstractRule {

    public function check($data)
    {
        if (preg_match('/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}/', $data))
        {
            return true;
        }
        $this->error = $this->attribute . " non è un'email valida";
    }
} 