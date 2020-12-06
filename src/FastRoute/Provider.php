<?php

namespace Simple\FastRoute;

use FastRoute\Dispatcher;
use Simple\FastRoute\Exceptions\HttpException;
use Simple\FastRoute\Exceptions\NotFoundException;
use Simple\FastRoute\Exceptions\MethodNotAllowedException;
use Simple\Support\Provider as SupportProvider;

class Provider implements SupportProvider
{
    const CATCH_FILE_NAME = 'routes.cache';

    /**
     * @var \FastRoute\Dispatcher;
     */
    protected $dispatcher = null;

    /**
     * A callable that use RouteCollector for create routes.
     * 
     * @var callable
     */
    protected $routeDefinitionCallback = null;

    /**
     * A callable that handle current route action.
     * 
     * @var callable
     */
    protected $routeHandler = null;

    /**
     * Arguments of current routeHandler.
     * 
     * @var array
     */
    protected $routeHandlerArguments = [];

    /**
     * A callable for exception handling which except an exception as the first argument.
     * 
     * @var callable
     */
    protected $errorHandler = null;

    /**
     * Http request path.
     * 
     * @var string
     */
    protected $path;

    /**
     * Http request method.
     * 
     * @var string
     */
    protected $method;

    /**
     * Specify using cache or not.
     * 
     * @var bool
     */
    protected $cacheDisabled;

    /**
     * Create new instance of Provider.
     * 
     * @param  callable $routeDefinitionCallback 
     * @param  callable $errorHandler
     * @return void
     */
    protected function __construct(
        callable $routeDefinitionCallback,
        callable $errorHandler = null,
        string $method,
        string $path,
        bool $cacheDisabled
    ) {
        $this->routeDefinitionCallback = $routeDefinitionCallback;

        $this->errorHandler = $errorHandler;

        $this->path = $path;

        $this->method = $method;

        $this->cacheDisabled = $cacheDisabled;
    }

    /**
     * Create a cache dispatcher.
     * 
     * @return void
     */
    protected function createDispatcher()
    {
        $this->dispatcher = \FastRoute\cachedDispatcher($this->routeDefinitionCallback, [
            'cacheFile' => __DIR__ . DIRECTORY_SEPARATOR . self::CATCH_FILE_NAME,
            'cacheDisabled' => $this->cacheDisabled,
        ]);
    }

    /**
     * Create dispatcher and execute.
     * 
     * @return array
     */
    protected function dispatch()
    {
        $this->createDispatcher();

        return $this->dispatcher->dispatch($this->method, $this->path);
    }

    /**
     * Search and intilize search results.
     * 
     * @return void
     */
    protected function search()
    {
        $routeInfo = $this->dispatch();

        $this->routeStatus = $routeInfo[0];
        $this->routeHandler = $routeInfo[1] ?? null;
        $this->routeHandlerArguments = array_values($routeInfo[2] ?? []);
    }

    /**
     * Call error handler if exist, otherwise throw exception.
     * 
     * @param  \Throwable $throwable
     * @return void
     * 
     * @throws \Throwable
     */
    protected function callErrorHandler(\Throwable $throwable)
    {
        $handler = $this->errorHandler;

        if ($handler) {
            $handler($throwable);

            return;
        }

        if ($throwable instanceof HttpException) {
            http_response_code($throwable->getCode());
        }

        throw $throwable;
    }

    /**
     * Call route handler.
     * 
     * @return void
     * 
     * @todo TODO: Create a service container and use it.
     */
    protected function callRouteHandler()
    {
        $handler = $this->routeHandler;

        //
        // If handler is pair of class and action name, create instance of class.
        //
        if (is_array($handler) && is_string($handler[0])) {
            $handler[0] = new $handler[0]();
        }

        try {
            call_user_func($handler, $this->routeHandlerArguments);
        } catch (\Throwable $throwable) {
            $this->callErrorHandler($throwable);
        }
    }

    /**
     * Decides what error to return based on the search results.
     * 
     * @return HttpException|void
     */
    protected function getRoutingException()
    {
        if ($this->routeStatus === Dispatcher::NOT_FOUND) {
            return NotFoundException::createWithMessage($this->path);
        }

        if ($this->routeStatus === Dispatcher::METHOD_NOT_ALLOWED) {
            return MethodNotAllowedException::createWithMessage($this->method, $this->path);
        }
    }

    /**
     * Decide what to do for a route.
     * 
     * @return void
     */
    public function route()
    {
        $this->search();

        if ($this->routeStatus === Dispatcher::FOUND) {
            $this->callRouteHandler();
        } else {
            $this->callErrorHandler(
                $this->getRoutingException()
            );
        }
    }

    /**
     * Register FastRoute as router, and start routing.
     * 
     * @return void
     */
    public function register()
    {
        $this->route();
    }

    /**
     * Set custom error handler.
     *
     * @param  callable  $errorHandler  A function that get a Throwable as its first argument.
     * @return $this
     */
    public function withErrorHandler(callable $callback)
    {
        $this->errorHandler = $callback;

        return $this;
    }

    /**
     * Create an instance of provider with all options.
     *
     * @param  callable $routeDefinitionCallback A function that get RouteCollecter as its first argument
     *                                           for example function ($router) { ... }.
     * @return $this
     */
    public static function create(callable $routeDefinitionCallback)
    {
        return new self(
            $routeDefinitionCallback,
            null,
            $_SERVER['REQUEST_METHOD'],
            $_SERVER['REQUEST_URI'],
            $_ENV['APP_DEBUG'] ?? false
        );
    }
}
