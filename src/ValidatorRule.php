<?php

namespace Fzaffa\Validator;

interface ValidatorRule {

    public function check($data);
}