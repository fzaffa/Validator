<?php

namespace Fzaffa\Validator;

use Fzaffa\Validator\Rules\RequiredRule;

class Validator {

    public $errors = array();

    protected $input;

    protected $rules;

    public function __construct($rules, $input)
    {
        $this->input = $input;
        $this->rules = $this->explodeRules($rules);
    }

    private function explodeRules($rules)
    {
        foreach ($rules as $attribute => &$rule) {

             $rule = explode('|', $rule);

            foreach ($rule as &$class) {

                if(strpos($class, ':')) {
                    list($class, $param) = explode(':', $class);
                }

                $class = 'Fzaffa\\Validator\\Rules\\'.ucfirst($class).'Rule';
                $class = (isset($param)) ? new $class($attribute, $param) : new $class($attribute);
                unset($param);
            }
        }
        return $rules;
    }

    public function addErrors($rule, $attribute)
    {
        if( isset($rule->error)) {
            $this->errors[$attribute][] = $rule->error;
        }
    }

    public function passes()
    {
        foreach ($this->rules as $attribute => $rules) {
            foreach ($rules as $rule) {
                $rule->check($this->getInput($attribute), $attribute);
                $this->addErrors($rule, $attribute);
            }
        }
        if(empty($this->errors)) return true;

        return false;
    }

    private function getInput($attribute)
    {
        $input = $this->input[$attribute];
        $input = trim($input);
        return $input;

    }


} 