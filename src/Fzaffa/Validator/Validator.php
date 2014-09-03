<?php

namespace Fzaffa\Validator;

class Validator {

    public $errors = array();

    protected $input;

    protected $rules;

    public function __construct($rules, $input)
    {
        $this->input = $input;
        try
        {
            $this->rules = $this->explodeRules($rules);
        }
        catch(\Exception $e)
        {
            throw new RuleNotFoundException($e);
        }
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
                if(class_exists($class))
                {
                    $class = (isset($param)) ? new $class($attribute, $param) : new $class($attribute);
                } else {
                    throw new \Exception("Rule '".$class."' not found.");
                }
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