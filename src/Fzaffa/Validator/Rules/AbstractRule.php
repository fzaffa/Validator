<?php

namespace Fzaffa\Validator\Rules;

use Fzaffa\Validator\ValidatorRule;

abstract class AbstractRule implements ValidatorRule {

    protected $attribute;

    protected $parameter;

    public $error;

    public function __construct($attribute, $parameter = null)
    {
        $this->attribute = $attribute;
        $this->parameter = $parameter;
    }

    abstract function check($data);
} 