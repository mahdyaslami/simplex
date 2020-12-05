<?php

namespace Simple\FastRoute;

use FastRoute\cachedDispather;

class Provider
{
    const DEFAULT_ROUTER_PATH = 'routes/index.php';

    /**
     * Path to router files.
     * 
     * @var null|array<string>
     */
    protected $routers = null;

    protected function __construct()
    {
        //
    }

    protected function createDispatcher()
    {
        //
    }

    protected function route($router)
    {
        if ($this->routers) {
            foreach ($this->routers as $router) {
                require_once($router);
            }

            return;
        }

        require_once(base_path(self::DEFAULT_ROUTER_PATH));
    }

    public function register()
    {
        //
    }

    public static function boot()
    {
        //
    }
}
