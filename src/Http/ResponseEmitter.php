<?php

namespace Simplex\Http;

use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Psr\Http\Message\ResponseInterface;
use Simplex\Contracts\ResponseEmitterInterface;

class ResponseEmitter implements ResponseEmitterInterface
{
    /**
     * {@inheritdoc}
     */
    public function emit(ResponseInterface $response)
    {
        (new SapiEmitter)->emit($response);
    }
}
