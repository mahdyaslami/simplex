<?php

namespace Simple\Validator;

use Simple\Validator\Contracts\Rule;

class RequiredRule extends Rule
{
    private string $key;

    private array $rules;

    public function __construct(string $key, array $rules)
    {
        $this->key = $key;
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
