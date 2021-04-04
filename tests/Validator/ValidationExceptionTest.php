<?php

namespace SimpleTests\Validator;

use Simple\Test\TestCase;
use Simple\Validator\Exceptions\ValidationException;

final class ValidationExceptionTest extends TestCase
{
    /**
     * @test
     * @covers \Simple\Validator\Exceptions\ValidationException
     * @uses \Simple\Test\TestCase
     */
    public function get_error_arrays()
    {
        $first = new ValidationException('first');
        $second = new ValidationException('second', 0, $first);

        $errors = $second->errors();

        $this->assertEquals('first', $errors[0]);
        $this->assertEquals('second', $errors[1]);
    }
}
