<?php

namespace Simple\Validator\Exceptions;

class ValidationException extends \Exception
{
    public function __construct($message = 'Invalid data.', \Throwable $previous = null)
    {
        parent::__construct($message, 422, $previous);
    }

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
