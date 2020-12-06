<?php

namespace Simple\Env;

use Simple\Support\Provider as SupportProvider;

class Provider implements SupportProvider
{
    /**
     * Path to env.php file.
     *
     * @var string
     */
    protected $env;

    /**
     * Create bew instance of Provider.
     *
     * @param  string $env  Path to env.php file.
     * @return void
     */
    protected function __construct($env)
    {
        $this->env = $env;
    }

    /**
     * Register a environment variables.
     *
     * @return void
     */
    public function register()
    {
        $_ENV = array_change_key_case(require($this->env), CASE_UPPER);
    }

    /**
     * Create instance of with env file.
     *
     * @return $this
     */
    public static function create($env)
    {
        return new self($env);
    }
}
