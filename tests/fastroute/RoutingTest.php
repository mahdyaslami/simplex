<?php

use FastRoute\RouteCollector;
use PHPUnit\Framework\TestCase;
use Simple\FastRoute\Exceptions\NotFoundException;
use Simple\FastRoute\Provider;

final class RoutingTest extends TestCase
{
    public function get($path)
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = $path;
    }

    /**
     * @test
     */
    public function route_with_anonymous_func()
    {
        $this->get('/users');

        Provider::create(function (RouteCollector $router) {
            $router->addRoute('GET', '/users', function () {
                echo 'true';
            });
        })->register();

        $this->expectOutputString('true');
    }

    /**
     * @test
     */
    public function route_with_class_func()
    {
        $this->get('/users');

        Provider::create(function (RouteCollector $router) {
            $router->addRoute('GET', '/users', [MyTestClass::class, 'index']);
        })->register();

        $this->expectOutputString('true');
    }

    /**
     * @test
     */
    public function route_not_found()
    {
        $this->get('/users/mahdi');

        try {
            Provider::create(function (RouteCollector $router) {
                $router->addRoute('GET', '/users', [MyTestClass::class, 'index']);
            })->register();
        } catch (\Throwable $e) {
            $this->assertInstanceOf(NotFoundException::class, $e, 'There is an error in test not found error.');
        }
    }
}

class MyTestClass
{
    public function index()
    {
        echo 'true';
    }
}
