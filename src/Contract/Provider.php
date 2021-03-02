<?php

namespace Simple\Contract;

interface Provider
{
    /**
     * Register a package.
     *
     * @return void
     */
    public function register();
}
