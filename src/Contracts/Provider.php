<?php

namespace Simple\Contracts;

interface Provider
{
    /**
     * Register a package.
     *
     * @return void
     */
    public function register();
}
