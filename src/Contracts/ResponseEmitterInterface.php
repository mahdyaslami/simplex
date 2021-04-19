<?php

namespace Simplex\Contracts;

use Psr\Http\Message\ResponseInterface;

/**
 * Get a response and fill output buffer and set headers and etc.
 */
interface ResponseEmitterInterface
{
    /**
     * Get a response and fill output buffer and set headers and etc.
     * 
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    public function emit(ResponseInterface $response);
}
