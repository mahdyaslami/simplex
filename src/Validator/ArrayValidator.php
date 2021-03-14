<?php

namespace Simple\Validator;

use Simple\Contract\Validator;

class ArrayValidator extends Validator
{
    private Validator $validator;

    public function __construct(Validator $validator)
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
