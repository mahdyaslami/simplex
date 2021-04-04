<?php

namespace Simple\Validator\Exceptions;

class ValidationException extends \Exception
{
    protected function details()
    {
        return $this->message;
    }

    private function getPreviousErrors()
    {
        $previous = $this->getPrevious();

        if ($previous instanceof ValidationException) {
            return $previous->errors();
        }

        return [];
    }

    public function errors()
    {
        $errors = $this->getPreviousErrors();

        array_push($errors, $this->details());

        return $errors;
    }
}
