<?php

use Simple\FastRoute\Exceptions\MethodNotAllowedException;
use Simple\FastRoute\Exceptions\NotFoundException;
use Simple\Test\TestCase;

final class ExceptionsTest extends TestCase
{
    /**
     * @test
     * @covers \Simple\FastRoute\Exceptions\MethodNotAllowedException
     * @uses \Simple\Test\TestCase
     */
    public function create_method_not_allowed_exception_with_correct_message()
    {
        $exception = MethodNotAllowedException::createWithMessage('METHOD', 'PATH');

        $this->assertEquals('`METHOD` method not allowed for `PATH` path.', $exception->getMessage(), 'Message is not correct.');
    }

    /**
     * @test
     * @covers \Simple\FastRoute\Exceptions\NotFoundException
     * @uses \Simple\Test\TestCase
     */
    public function create_not_fount_exception_with_correct_message()
    {
        $exception = NotFoundException::createWithMessage('PATH');

        $this->assertEquals('`PATH` Not found.', $exception->getMessage(), 'Message is not correct.');
    }
}
