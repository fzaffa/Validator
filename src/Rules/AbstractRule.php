<?php

namespace Fzaffa\Validator\Rules;

use Fzaffa\Validator\ValidatorRule;

abstract class AbstractRule implements ValidatorRule {

    protected $attribute;

    protected $parameter;

    protected $error;

    public function __construct($attribute, $parameter = null)
    {
        $this->attribute = $attribute;
        $this->parameter = $parameter;
        $this->error = $this->getRuleName();
    }

    abstract function check($data);

    public function __get($method)
    {
        return $this->{$method};
    }

    private function getRuleName()
    {
        $arr = explode('\\', get_class($this));
        return strtolower(substr(end($arr), 0, -4));
    }
} 