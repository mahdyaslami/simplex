<?php

namespace Simplex\Http;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Simplex\Contracts\ApplicationInterface;
use Simplex\Contracts\ExceptionHandlerInterface;
use Simplex\Contracts\RequestFactoryInterface;

class Application implements ApplicationInterface
{
    protected $requestFactory;
    protected $requestHandler;
    protected $exceptionHandler;

    public function __construct(
        RequestFactoryInterface $requestFactory,
        RequestHandlerInterface $requestHandler,
        ExceptionHandlerInterface $exceptionHandler
    ) {
        $this->requestFactory = $requestFactory;
        $this->requestHandler = $requestHandler;
        $this->exceptionHandler = $exceptionHandler;
    }

    public function run()
    {
        $request = null;

        try {
            $request = $this->requestFactory->generate();

            $response = $this->requestHandler->handle($request);
        } catch (\Throwable $e) {
            $response = $this->exceptionHandler->handle($e, $request);
        } finally {
            $this->terminate($response);
        }
    }

    protected function terminate(ResponseInterface $response)
    {
        // TODO
    }
}
