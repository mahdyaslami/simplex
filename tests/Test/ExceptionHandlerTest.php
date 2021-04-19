<?php

namespace Tests\Test;

use Exception;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\ServerRequest;
use OutOfRangeException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Simplex\Http\ExceptionHandler;
use Simplex\Test\TestCase;

final class ExceptionHandlerTest extends TestCase
{
    /**
     * @test
     * @covers \Simplex\Http\ExceptionHandler
     */
    public function throw_exception_when_no_exception_handled()
    {
        $exceptionHandler = new ExceptionHandler();

        $exception = new Exception();
        $catchedException = null;
        try {
            $exceptionHandler->handle($exception, null);
        } catch (\Throwable $e) {
            $catchedException = $e;
        }

        $this->assertNotNull($catchedException, 'Should get exception when there is no handler.');
        $this->assertEquals($exception, $catchedException, 'Should get exception when there is no handler.');
    }

    /**
     * @test
     * @covers \Simplex\Http\ExceptionHandler
     */
    public function throw_exception_when_does_not_find_handler_for_exception()
    {
        $exceptionHandler = new ExceptionHandler();

        $exceptionHandler->render(OutOfRangeException::class, function () {
            return new Response();
        });

        $exception = new Exception();
        $catchedException = null;
        try {
            $exceptionHandler->handle($exception, null);
        } catch (\Throwable $e) {
            $catchedException = $e;
        }

        $this->assertNotNull($catchedException, 'Should get exception when cannot find any handler.');
        $this->assertEquals($exception, $catchedException, 'Should get exception when cannot find any handler.');
    }

    /**
     * @test
     * @covers \Simplex\Http\ExceptionHandler
     */
    public function does_not_throw_exception_when_find_a_handler()
    {
        $exceptionHandler = new ExceptionHandler();

        $exceptionHandler->render(OutOfRangeException::class, function () {
            return new Response();
        });

        $exception = new OutOfRangeException();
        $catchedException = null;
        try {
            $exceptionHandler->handle($exception, null);
        } catch (\Throwable $e) {
            $catchedException = $e;
        }

        $this->assertNull($catchedException, 'Should not get exception when there is handler.');
    }

    /**
     * @test
     * @covers \Simplex\Http\ExceptionHandler
     */
    public function should_return_response()
    {
        $exceptionHandler = new ExceptionHandler();

        $exceptionHandler->render(OutOfRangeException::class, function () {
            return new Response();
        });

        $response = $exceptionHandler->handle(new OutOfRangeException(), null);

        $this->assertInstanceOf(ResponseInterface::class, $response, 'ExceptionHandler should return of type response.');
    }

    /**
     * @test
     * @covers \Simplex\Http\ExceptionHandler
     */
    public function should_send_exception_and_request_to_handler()
    {
        $exceptionHandler = new ExceptionHandler();

        $exceptionHandler->render(OutOfRangeException::class, function (\Throwable $e, $request) {
            $this->assertInstanceOf(OutOfRangeException::class, $e, 'Should send exception to handler.');
            $this->assertInstanceOf(ServerRequestInterface::class, $request, 'Should send request of type ServerRequsetInterface.');

            return new Response();
        });

        $exceptionHandler->handle(new OutOfRangeException(), new ServerRequest());
    }

    /**
     * @test
     * @covers \Simplex\Http\ExceptionHandler
     */
    public function should_send_null_as_request_to_handler()
    {
        $exceptionHandler = new ExceptionHandler();

        $exceptionHandler->render(OutOfRangeException::class, function (\Throwable $e, $request) {
            $this->assertNull($request, 'Should get null when request does not exists.');

            return new Response();
        });

        $exceptionHandler->handle(new OutOfRangeException(), null);
    }
}
