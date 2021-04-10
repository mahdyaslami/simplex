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

    public function validate($value)
    {
        $this->check($value);

        if ($this->getNext()) {
            $this->getNext()->validate($value[$this->key]);
        }
    }
}
