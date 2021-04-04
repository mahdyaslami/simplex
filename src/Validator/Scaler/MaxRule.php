<?php

namespace Simple\Validator\Scaler;

use Exception;
use Simple\Validator\Contracts\Rule;

class MaxRule extends Rule
{
    private $maximum;

    public function __construct($maximum)
    {
        $this->maximum = $maximum;
    }

    public function validate($value)
    {
        if (is_nan($value)) {
            throw new Exception('Value should be number.');
        }

        if ($value > $this->maximum) {
            throw new Exception("Value must be lower than {$this->maximum}");
        }
    }
}
