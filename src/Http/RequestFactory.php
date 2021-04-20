<?php

namespace Simplex\Http;

use Laminas\Diactoros\ServerRequestFactory;
use Psr\Http\Message\ServerRequestInterface;
use Simplex\Contracts\RequestFactoryInterface;

class RequestFactory implements RequestFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function generate(): ServerRequestInterface
    {
        return ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);
    }
}
