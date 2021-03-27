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
     * @covers \Simple\FastRoute\Provider
     * @uses \Simple\Test\TestCase
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
     * @covers \Simple\FastRoute\Provider
     * @uses \Simple\Test\TestCase
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
     * @covers \Simple\FastRoute\Provider
     * @uses Simple\FastRoute\Exceptions\NotFoundException
     * @uses Simple\Test\TestCase
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
     * @covers \Simple\FastRoute\Provider
     * @uses Simple\FastRoute\Exceptions\MethodNotAllowedException
     * @uses Simple\Test\TestCase
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

    /**
     * @test
     * @covers \Simple\FastRoute\Provider
     * @uses Simple\Test\TestCase
     */
    public function can_get_app_exception()
    {
        $this->get('/users');

        try {
            Provider::create(function (RouteCollector $router) {
                $router->addRoute('GET', '/users', function() {
                    throw new Exception('TEST');
                });
            })->register();
        } catch (\Throwable $e) {
            $this->assertEquals('TEST', $e->getMessage(), 'Can\'t get application exceptions.');
        }
    }

    /**
     * @test
     * @covers \Simple\FastRoute\Provider
     * @uses Simple\FastRoute\Exceptions\NotFoundException
     * @uses Simple\Test\TestCase
     */
    public function using_error_handler_work()
    {
        $this->get('/users/mahdi');

        try {
            Provider::create(function (RouteCollector $router) {
                $router->addRoute('GET', '/users', [MyTestClass::class, 'index']);
            })->withErrorHandler(function ($e) {
                $this->assertTrue(true);
            })->register();
        } catch (\Throwable $e) {
            $this->assertTrue(false, 'Error handler does not work.');
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
