<?php

namespace Tests\Http;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Simplex\Test\TestCase;
use Simplex\Contracts\ExceptionHandlerInterface;
use Simplex\Contracts\RequestFactoryInterface;
use Simplex\Contracts\ResponseEmitterInterface;
use Simplex\Http\Application;

final class ApplicationTest extends TestCase
{
    /**
     * @test
     * @covers \Simplex\Http\Application
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

        $responseEmitter = \Mockery::mock(ResponseEmitterInterface::class);
        $responseEmitter->shouldReceive('emit')->once();

        (new Application(
            $requestFactory,
            $requestHandler,
            $exceptionHandler,
            $responseEmitter
        ))->run();

        \Mockery::close();

        $this->assertTrue(true);
    }

    /**
     * @test
     * @covers \Simplex\Http\Application
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

        $responseEmitter = \Mockery::mock(ResponseEmitterInterface::class);
        $responseEmitter->shouldReceive('emit')->once();

        (new Application(
            $requestFactory,
            $requestHandler,
            $exceptionHandler,
            $responseEmitter
        ))->run();

        \Mockery::close();

        $this->assertTrue(true);
    }
}
