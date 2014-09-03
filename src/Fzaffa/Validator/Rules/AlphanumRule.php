<?php

namespace Fzaffa\Validator\Rules;

class AlphanumRule extends AbstractRule{

    public function check($data)
    {
        if(ctype_alnum($data))
        {
            return true;
        }
        $this->error = $this->attribute." deve essere alfanumerico";
    }
}