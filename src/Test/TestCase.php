<?php

namespace Simplex\Test;

use PHPUnit\Framework\TestCase as FrameworkTestCase;

class TestCase extends FrameworkTestCase
{
    /**
     * Prepare php variables for get request.
     * 
     * @param string $path
     * @return void
     */
    public function get($path)
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = $path;
    }

    /**
     * Prepare php variables for post request.
     * 
     * @param string $path
     * @return void
     */
    public function post($path)
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['REQUEST_URI'] = $path;
    }
}
