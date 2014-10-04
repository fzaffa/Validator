<?php

namespace Fzaffa\Validator;

class Validator {

    /**
     * @var array
     */
    public $errors = [];

    /**
     * @var
     */
    protected $input;

    /**
     * @var
     */
    protected $rules;

    protected $errorMessages;

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
        } catch (\Exception $e)
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
        foreach ($rules as $attribute => &$rule)
        {
            /*
             * If $rule is not an array then split the single rules
             * */
            if ( ! is_array($rule))
            {

                $rule = $this->splitIntoListOfRules($rule);

                foreach ($rule as &$class)
                {

                    $class = $this->parseAndInstantiateClassOrFail($class, $attribute);
                }
            }
            /*
             * Handle nested rules
             * */
            elseif (is_array($this->input[$attribute]))
            {
                $rule = $this->explodeRules($rule);
            }
        }

        return $rules;
    }

    /**
     * @param $rule
     * @param $attribute
     */
    private function addErrors($rule, $attribute)
    {
        $this->errors[$attribute][] = $this->parseMessage($rule);
    }

    /**
     * @return bool
     */
    public function passes()
    {
        foreach ($this->rules as $attribute => $rules)
        {
            foreach ($rules as $name => $rule)
            {
                if ( ! is_array($rule))
                {
                    if ( ! $rule->check($this->getInput($attribute), $attribute))
                    {
                        $this->addErrors($rule, $attribute);
                    }
                }

                /*
                 * Handle nested rules
                 * */
                else
                {
                    //get the input array
                    $inputs = $this->getInput($attribute);
                    //Loop through the input blocks
                    foreach ($inputs as $input)
                    {
                        //loop through rules saved as arrays
                        foreach ($this->rules[$attribute][$name] as $rule)
                        {
                            if ( ! $rule->check($input[$name], $name))
                            {
                                $this->addErrors($rule, $name);
                            }
                        }

                    }

                }
            }
        }

        return count($this->errors) === 0;
    }

    public function iterate($attribute, $rules)
    {

    }

    /**
     * @param $attribute
     * @return string
     */
    private function getInput($attribute)
    {
        $input = $this->input[$attribute];
        $input = is_string($input) ? trim($input) : $input;

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
        if (strpos($class, ':'))
        {
            return explode(':', $class);
        }
        else
        {
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

        if (class_exists($classFullName))
        {
            $class = $this->InstantiateClassWithParams($classFullName, $attribute, $param);
        }
        else
        {
            throw new \Exception("Rule '" . $class . "' not found.");
        }
        unset($param);

        return $class;
    }

    private function loadMessages()
    {
        $this->errorMessages = include 'ErrorMessages.php';
    }

    private function parseMessage($rule)
    {
        $msg = $this->getErrorMessage($rule->error);
        if ($rule->parameter && strpos($msg, ':param'))
        {
            $msg = str_replace(':param', $rule->parameter, $msg);
        }

        return str_replace(':attribute', $rule->attribute, $msg);
    }

    private function getErrorMessage($name)
    {
        if ( ! $this->errorMessages)
        {
            $this->loadMessages();
        }

        return $this->errorMessages[$name];
    }
}