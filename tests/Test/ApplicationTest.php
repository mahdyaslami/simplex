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
    public function app_generate_request_and_call_request_handler()
    {
        $request = \Mockery::mock(ServerRequestInterface::class);

        $requestFactory = \Mockery::mock(RequestFactoryInterface::class);
        $requestFactory->shouldReceive('generate')->andReturn($request)->once();

        $requestHandler = \Mockery::mock(RequestHandlerInterface::class);
        $requestHandler->shouldReceive('handle')->once();

        $exceptionHandler = \Mockery::mock(ExceptionHandlerInterface::class);
        $exceptionHandler->shouldNotReceive('handle');

        (new Application(
            $requestFactory,
            $requestHandler,
            $exceptionHandler
        ))->run();

        \Mockery::close();

        $this->assertTrue(true);
    }

    /**
     * @test
     * @covers \Simplex\Test\TestCase
     */
    public function app_call_exception_handler()
    {
        $request = \Mockery::mock(ServerRequestInterface::class);

        $requestFactory = \Mockery::mock(RequestFactoryInterface::class);
        $requestFactory->shouldReceive('generate')->andReturn($request)->once();

        $requestHandler = \Mockery::mock(RequestHandlerInterface::class);
        $requestHandler->shouldReceive('handle')->andThrow(new \Exception);

        $exceptionHandler = \Mockery::mock(ExceptionHandlerInterface::class);
        $exceptionHandler->shouldReceive('handle')->once();

        (new Application(
            $requestFactory,
            $requestHandler,
            $exceptionHandler
        ))->run();

        \Mockery::close();

        $this->assertTrue(true);
    }
}
