<?php

namespace Fzaffa\Validator\Rules;

use Fzaffa\Validator\ValidatorRule;

class MaxRule implements ValidatorRule{
    public $error;

    private $parameter;

    public function __construct($parameter)
    {
        $this->parameter = $parameter;
    }

    public function check($data, $attribute)
    {
        if (strlen($data) <= (int)$this->parameter)
        {
            return true;
        }
        $this->error = $attribute. "deve essere massimo ".$this->parameter. " caratteri.";
    }
}