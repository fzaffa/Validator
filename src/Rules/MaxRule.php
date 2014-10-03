<?php

namespace Fzaffa\Validator\Rules;

class MaxRule extends AbstractRule {

    public function check($data)
    {
        if (strlen($data) <= (int) $this->parameter)
        {
            return true;
        }
        return false;
    }
}