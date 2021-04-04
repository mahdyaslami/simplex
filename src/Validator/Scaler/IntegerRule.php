<?php

namespace Simple\Validator\Scaler;

use Exception;
use Simple\Validator\Contracts\Rule;

class IntegerRule extends Rule
{
    public function validate($value)
    {
        if (!is_int($value)) {
            throw new Exception('Value must be integer.');
        }
    }
}
