<?php

namespace Simple\Validator;

use Exception;
use Simple\Validator\Contracts\KeyValueRule;

class RequiredRule extends KeyValueRule
{
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
