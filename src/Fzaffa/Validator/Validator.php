<?php

namespace Fzaffa\Validator;

class Validator {

    /**
     * @var array
     */
    public $errors = array();

    /**
     * @var
     */
    protected $input;

    /**
     * @var
     */
    protected $rules;

    /**
     * @param $rules
     * @param $input
     * @throws RuleNotFoundException
     */
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

    /**
     * @param $rules
     * @return array
     * @throws \Exception
     */
    private function explodeRules($rules)
    {
        foreach ($rules as $attribute => &$rule) {

            $rule = $this->splitIntoListOfRules($rule);

            foreach ($rule as &$class) {

                $class = $this->parseAndInstantiateClassOrFail($class, $attribute);
            }
        }
        return $rules;
    }

    /**
     * @param $rule
     * @param $attribute
     */
    public function addErrors($rule, $attribute)
    {
        if( isset($rule->error)) {
            $this->errors[$attribute][] = $rule->error;
        }
    }

    /**
     * @return bool
     */
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

    /**
     * @param $attribute
     * @return string
     */
    private function getInput($attribute)
    {
        $input = $this->input[$attribute];
        $input = trim($input);
        return $input;

    }

    /**
     * @param $rule
     * @return array
     */
    private function splitIntoListOfRules($rule)
    {
        return explode('|', $rule);
    }

    /**
     * @param $param
     * @param $classFullName
     * @param $attribute
     * @return \Fzaffa\Validator\ValidatorRule
     */
    private function InstantiateClassWithParams($classFullName, $attribute, $param = null)
    {
        return ($param) ? new $classFullName($attribute, $param) : new $classFullName($attribute);
    }

    /**
     * @param $class
     * @return array
     */
    private function splitClassNameFromParam($class)
    {
        if (strpos($class, ':')) {
            return explode(':', $class);
        } else {
            return [$class, null];
        }
    }

    /**
     * @param $class
     * @param $attribute
     * @return \Fzaffa\Validator\ValidatorRule
     * @throws \Exception
     */
    private function parseAndInstantiateClassOrFail($class, $attribute)
    {
        list($className, $param) = $this->splitClassNameFromParam($class);

        $classFullName = 'Fzaffa\\Validator\\Rules\\' . ucfirst($className) . 'Rule';

        if (class_exists($classFullName)) {
            $class = $this->InstantiateClassWithParams($classFullName, $attribute, $param);
        } else {
            throw new \Exception("Rule '" . $class . "' not found.");
        }
        unset($param);
        return $class;
    }
}