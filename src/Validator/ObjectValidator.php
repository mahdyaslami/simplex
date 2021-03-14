<?php

namespace Simple\Validator;

use Simple\Contract\Validator;

class ObjectValidator extends Validator
{
    private array $rules;

    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    public function validate($object)
    {
        $this->emtpyErrors();

        foreach ($this->rules as $rule) {
            $rule->validate($object);

            $this->addErrors($rule->errors);
        }
    }
}
