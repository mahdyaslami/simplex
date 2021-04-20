<?php

namespace Simplex\Contracts;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Handle an exception and produce a response.
 * 
 * Handle an exception that throwed through a request handling.
 */
interface ExceptionHandlerInterface
{
    /**
     * Handles an exception and produces a response.
     *
     * May call other collaborating code to generate the response.
     * 
     * @param  \Throwable $exception
     * @param  null|\Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(\Throwable $exception, ServerRequestInterface $request = null): ResponseInterface;
}
