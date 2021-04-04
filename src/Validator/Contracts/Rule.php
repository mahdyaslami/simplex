<?php

namespace Simple\Validator\Contracts;

abstract class Rule
{
    /**
     * Validate value by rules.
     * 
     * @param  mixed $value The value you want to validate.
     * @return void
     */
    public abstract function validate($value);
}
