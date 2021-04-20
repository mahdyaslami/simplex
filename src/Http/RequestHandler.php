<?php

namespace Simplex\Http;

use League\Route\Cache\FileCache;
use League\Route\Cache\Router as CacheRouter;
use League\Route\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RequestHandler implements RequestHandlerInterface
{
    protected CacheRouter $cacheRouter;

    protected Router $router;

    /**
     * Create instance of request handler.
     * 
     * @param  string $pathToCacheFile
     * @param  bool $cacheEnabled
     * @param  int $ttl
     * @return void
     */
    public function __construct(string $pathToCacheFile, $cacheEnabled = true, $ttl = 86400)
    {
        $cacheStore = new FileCache($pathToCacheFile, $ttl);

        $this->router = new Router();

        $this->cacheRouter = new CacheRouter([$this, 'getRouter'], $cacheStore, $cacheEnabled);
    }

    /**
     * Get router.
     * 
     * @return \League\Route\Router
     */
    public function getRouter(): Router
    {
        return $this->router;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->router->dispatch($request);
    }
}
