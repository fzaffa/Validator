<?php

namespace Fzaffa\Validator\Rules;

class RequiredRule extends AbstractRule {

    public function check($data)
    {
        if (isset($data) && $data != '')
        {
            return true;
        }
        return false;
    }
}