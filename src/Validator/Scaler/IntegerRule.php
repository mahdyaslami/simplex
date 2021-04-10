<?php

namespace Simple\Validator\Scaler;

use Simple\Validator\Contracts\Rule;
use Simple\Validator\Exceptions\OnlyIntegerAllowedException;

class IntegerRule extends Rule
{
    public function check($value)
    {
        if (!is_int($value)) {
            throw new OnlyIntegerAllowedException();
        }
    }
}
