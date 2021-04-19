<?php

namespace Tests\Test;

use Laminas\Diactoros\Request;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\ServerRequest;
use League\Route\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Simplex\Test\TestCase;
use Simplex\Http\RequestHandler;

final class RequestHandlerTest extends TestCase
{
    /**
     * @test
     * @covers \Simplex\Http\RequestHandler
     */
    public function handle_a_request_and_get_response()
    {
        $request = new ServerRequest([], [], '/', 'GET');
        $requestHandler = new RequestHandler('');

        $router = $requestHandler->getRouter();
        $router->get('/', function () {
            $this->assertTrue(true);
            return new Response();
        });

        $response = $requestHandler->handle($request);

        $this->assertInstanceOf(ResponseInterface::class, $response, 'RequestHandler should return response of ResponseInterface type.');
    }

    /**
     * @test
     * @covers \Simplex\Http\RequestHandler
     */
    public function get_router_for_creating_route()
    {
        $requestHandler = new RequestHandler('');

        $router = $requestHandler->getRouter();
        $router->get('/', function () {
            $this->assertTrue(true);
            return new Response();
        });

        $this->assertInstanceOf(Router::class, $router, 'RequestHandler should return a router.');
    }
}
