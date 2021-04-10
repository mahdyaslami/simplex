<?php

namespace Simple\Validator\Contracts;

abstract class Rule
{

    public function validate($value)
    {
        $this->check($value);
    }

    /**
     * check value by rules.
     * 
     * @param  mixed $value The value you want to check.
     * @return void
     */
    public abstract function check($value);
}
