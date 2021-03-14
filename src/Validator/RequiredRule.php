<?php

namespace Simple\Validator;

use Simple\Contract\Validator;

class RequiredRule extends Validator
{
    private string $key;

    private array $rules;

    public function __construct(string $key, array $rules)
    {
        $this->rules = $rules;
    }

    public function validate($object)
    {
        $this->emtpyErrors();

        if (isset($object['$key']) == false) {
            array_merge($this->errors, [
                "'{$this->key}' key is required."
            ]);
        }
    }
}
