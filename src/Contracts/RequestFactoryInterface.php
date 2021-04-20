<?php

namespace Simplex\Contracts;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Create request based on PSR.
 */
interface RequestFactoryInterface
{
    /**
     * Create request based on PSR.
     * 
     * @return \Psr\Http\Message\ServerRequestInterface
     */
    public function generate(): ServerRequestInterface;
}
