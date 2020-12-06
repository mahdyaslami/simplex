<?php

namespace Simple\Env;

use Simple\Support\Provider as SupportProvider;

class Provider implements SupportProvider
{
    /**
     * Register a environment variables.
     *
     * @return void
     */
    public function register()
    {
        $env_php = base_path('env.php');

        if (file_exists($env_php)) {
            $_ENV = array_change_key_case(require_once($env_php), CASE_UPPER);
        }
    }
}
