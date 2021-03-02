<?php

namespace Simple\Support;

interface Validator
{
    /**
     * Validate value by rules.
     * 
     * @param  mixed $value The value you want to validate.
     * @return void
     */
    public function validate($value): bool;
}
