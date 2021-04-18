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
     */
    public function generate(): ServerRequestInterface;
}
