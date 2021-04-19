<?php

namespace Simplex\Http;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Simplex\Contracts\ExceptionHandlerInterface;

class ExceptionHandler implements ExceptionHandlerInterface
{
    protected $handlers = [];

    /**
     * Set a handler for an exact exception.
     * 
     * @param string $exceptionType
     * @param callable $handler
     * @return void
     */
    public function render($exceptionType, callable $handler)
    {
        $this->handlers[$exceptionType] = $handler;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(\Throwable $exception, ServerRequestInterface $request = null): ResponseInterface
    {
        if ($handler = $this->findHandler(get_class($exception))) {
            return $handler($exception, $request);
        }

        throw $exception;
    }

    /**
     * Find handler or return null.
     * 
     * @param $key
     * @return null|callable
     */
    protected function findHandler($key)
    {
        if (array_key_exists($key, $this->handlers)) {
            return $this->handlers[$key];
        }

        return null;
    }
}
