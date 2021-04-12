<?php

namespace Simple\Validator\Contracts;

abstract class KeyValueRule extends Rule
{
    protected string $key;

    public function __construct(string $key, array $rules = [])
    {
        parent::__construct($rules);

        $this->key = $key;
    }

    public function getNextValue($value)
    {
        return $value[$this->key];
    }
}
