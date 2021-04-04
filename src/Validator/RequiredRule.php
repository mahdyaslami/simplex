<?php

namespace Simple\Validator;

use Exception;
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
        $isKeyExists = false;

        if (is_object($object)) {
            $isKeyExists = isset($object->{$this->key});
        } else  {
            $isKeyExists = isset($object[$this->key]);
        }

        if (!$isKeyExists) {
            throw new Exception("{$this->key} does not exists.");
        }
    }
}
