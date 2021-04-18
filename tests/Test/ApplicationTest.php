<?php

namespace Tests\Test;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Simplex\Test\TestCase;
use Simplex\Contracts\ExceptionHandlerInterface;
use Simplex\Contracts\RequestFactoryInterface;
use Simplex\Http\Application;

final class ApplicationTest extends TestCase
{
    /**
     * @test
     * @covers \Simplex\Test\TestCase
     */
    public function app_generate_request()
    {
        $request = \Mockery::mock(ServerRequestInterface::class);

        $requestFactory = \Mockery::mock(RequestFactoryInterface::class);
        $requestFactory->shouldReceive('generate')->andReturn($request);

        $requestHandler = \Mockery::mock(RequestHandlerInterface::class);
        $exceptionHandler = \Mockery::mock(ExceptionHandlerInterface::class);

        (new Application($requestFactory, $requestHandler, $exceptionHandler))->run();
    }

    /**
     * @test
     * @covers \Simplex\Test\TestCase
     */
    public function app_call_request_handler()
    {
    }

    /**
     * @test
     * @covers \Simplex\Test\TestCase
     */
    public function app_call_exception_handler()
    {
    }
}
