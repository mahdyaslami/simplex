<?php

namespace Simple\Validator\Scaler;

use Simple\Validator\Contracts\Rule;
use Simple\Validator\Exceptions\GreaterNumberNotAllowedException;
use Simple\Validator\Exceptions\OnlyNumberAllowedException;

class MaximumRule extends Rule
{
    private $maximum;

    public function __construct($maximum)
    {
        $this->maximum = $maximum;
    }

    public function check($value)
    {
        if (!is_numeric($value)) {
            throw new OnlyNumberAllowedException();
        }

        if ($value > $this->maximum) {
            throw new GreaterNumberNotAllowedException($this->maximum);
        }
    }
}
