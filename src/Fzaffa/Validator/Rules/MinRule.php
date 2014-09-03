<?php

namespace Fzaffa\Validator\Rules;

use Fzaffa\Validator\ValidatorRule;

class MinRule implements ValidatorRule{

    public $error;

    private $parameter;

    public function __construct($parameter)
    {
        $this->parameter = $parameter;
    }

    public function check($data, $attribute)
    {
        if (strlen($data) >= (int)$this->parameter)
        {
            return true;
        }
        $this->error = $attribute. " deve essere minimo ".$this->parameter. " caratteri.";
    }
}