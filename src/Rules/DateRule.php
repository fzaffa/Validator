<?php

namespace Fzaffa\Validator\Rules;

class DateRule extends AbstractRule {

    public function check($data)
    {
        $date = date_parse_from_format($this->parameter,$data);
        return $date['error_count'] === 0;
    }
} 