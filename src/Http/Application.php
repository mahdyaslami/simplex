<?php

namespace Simplex\Http;

use Psr\Http\Server\RequestHandlerInterface;
use Simplex\Contracts\ApplicationInterface;
use Simplex\Contracts\ExceptionHandlerInterface;
use Simplex\Contracts\RequestFactoryInterface;
use Simplex\Contracts\ResponseEmitterInterface;

/**
 * A web application.
 */
class Application implements ApplicationInterface
{
    protected $requestFactory;
    protected $requestHandler;
    protected $exceptionHandler;
    protected $responseEmitter;

    /**
     * Create new application instance.
     * 
     * @param  RequestFactoryInterface $requestFactory
     * @param  RequestHandlerInterface $requestHandler
     * @param  ExceptionHandlerInterface $exceptionHandler
     * @param  ResponseEmitterInterface $responseEmitter
     * @return void
     */
    public function __construct(
        RequestFactoryInterface $requestFactory,
        RequestHandlerInterface $requestHandler,
        ExceptionHandlerInterface $exceptionHandler,
        ResponseEmitterInterface $responseEmitter
    ) {
        $this->requestFactory = $requestFactory;
        $this->requestHandler = $requestHandler;
        $this->exceptionHandler = $exceptionHandler;
        $this->responseEmitter = $responseEmitter;
    }

    /**
     * Run application and execute error handler if 
     * error happened.
     * 
     * @return void
     */
    public function run()
    {
        $request = null;

        try {
            $request = $this->requestFactory->generate();

            $response = $this->requestHandler->handle($request);
        } catch (\Throwable $e) {
            $response = $this->exceptionHandler->handle($e, $request);
        } finally {
            $this->responseEmitter->emit($response);
        }
    }
}
