<?php

if (!function_exists('base_path')) {
    /**
     * Determine if the application is running in the console.
     *
     * @return bool
     */
    function running_in_console()
    {
        return \PHP_SAPI === 'cli' || \PHP_SAPI === 'phpdbg';
    }
}

if (!function_exists('base_path')) {
    /**
     * Get the path to the base of the install.
     *
     * @param  string  $path
     * @return string
     */
    function base_path($path = '')
    {
        if (isset($GLOBALS['BASE_PATH'])) {
            $path = trim($path, '/\\');

            return $GLOBALS['BASE_PATH'] . ($path ? DIRECTORY_SEPARATOR . $path : $path);
        }

        if (running_in_console()) {
            $GLOBALS['BASE_PATH'] = getcwd();
        } else {
            $GLOBALS['BASE_PATH'] = realpath(getcwd());
        }

        return base_path($path);
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
     * @param string $key
     * @param mixed $value
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
