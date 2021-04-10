<?php

namespace Simple\Validator;

use Exception;
use Simple\Validator\Contracts\Rule;

class RequiredRule extends Rule
{
    private string $key;

    public function __construct(string $key, array $rules = [])
    {
        parent::__construct($rules);

        $this->key = $key;
    }

    public function check($object)
    {
        $isKeyExists = false;

        if (is_object($object)) {
            $isKeyExists = isset($object->{$this->key});
        } else {
            $isKeyExists = isset($object[$this->key]);
        }

        if (!$isKeyExists) {
            throw new Exception("{$this->key} does not exists.");
        }
    }
}
