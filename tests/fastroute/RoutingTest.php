<?php

use FastRoute\RouteCollector;
use Simple\FastRoute\Exceptions\MethodNotAllowedException;
use Simple\FastRoute\Exceptions\NotFoundException;
use Simple\FastRoute\Provider;
use Simple\Test\TestCase;

final class RoutingTest extends TestCase
{
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

    /**
     * @test
     */
    public function method_not_allowed()
    {
        $this->post('/users');

        try {
            Provider::create(function (RouteCollector $router) {
                $router->addRoute('GET', '/users', [MyTestClass::class, 'index']);
            })->register();
        } catch (\Throwable $e) {
            $this->assertInstanceOf(MethodNotAllowedException::class, $e, 'There is an error in test method not allowed error.');
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
