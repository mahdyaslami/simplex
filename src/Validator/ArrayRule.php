<?php

namespace Simple\Rule;

use Simple\Validator\Contracts\Rule;

class ArrayRule extends Rule
{
    private Rule $validator;

    public function __construct(Rule $validator)
    {
        $this->validator = $validator;
    }

    public function validate($items)
    {
        $this->emtpyErrors();

        foreach ($items as $item) {
            $this->validator->validate($item);

            $this->addErrors($this->validator->errors());
        }
    }
}
