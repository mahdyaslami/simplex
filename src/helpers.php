<?php

if (!function_exists('base_path')) {
    /**
     * Get the path to the base of the working directory.
     *
     * @param  string  $path
     * @return string
     */
    function base_path($path = '')
    {
        return $GLOBALS['BASE_PATH'] . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('env')) {
    /**
     * Get or set environment variable
     * 
     * For setting a value send both $key and $value parameters
     * 
     * For getting a value only send $key parameter.
     * 
     * @param  string  $key
     * @param  mixed   $value
     * @return mixed
     */
    function env($key, $value = null)
    {
        $key = strtoupper($key);

        if ($value) {
            $_ENV[$key] = $value;
        }

        return $_ENV[$key];
    }
}
