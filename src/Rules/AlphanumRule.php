<?php

namespace Fzaffa\Validator\Rules;

class AlphanumRule extends AbstractRule {

    public function check($data)
    {
        if (ctype_alnum($data))
        {
            return true;
        }
        return false;
    }
}