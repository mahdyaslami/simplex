<?php

namespace Simple\Contract;

abstract class Validator
{
    private $errors = [];

    /**
     * Validate value by rules.
     * 
     * @param  mixed $value The value you want to validate.
     * @return void
     */
    public abstract function validate($value): void;

    /**
     * Get error of last validated value.
     * 
     * @return array
     */
    public function errors()
    {
        return $this->errors;
    }

    protected function addErrors(array $errors)
    {
        array_merge($this->errors, $errors);
    }

    protected function emtpyErrors()
    {
        $this->errors = [];
    }
}
