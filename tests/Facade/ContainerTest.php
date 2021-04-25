<?php

namespace Tests\Test;

use League\Container\Exception\ContainerException;
use Mockery;
use Simplex\Facade\Container;
use Simplex\Test\TestCase;

final class ContainerTest extends TestCase
{
    private function container()
    {
        return Container::getInstance();
    }

    /**
     * @test
     * @covers \Simplex\Facade\Container::getInstance
     */
    public function container_is_singleton()
    {
        $container = Container::getInstance();

        $this->assertEquals($container, Container::getInstance(), 'Container should be singleton.');
    }

    /**
     * @test
     * @covers \Simplex\Facade\Container::bind
     */
    public function bind_method_can_bind_object()
    {
        $classname = 'temp1';
        $this->container()->bind($classname, Mockery::mock());

        $this->assertIsObject($this->container()->get($classname));
    }

    /**
     * @test
     * @covers \Simplex\Facade\Container::bind
     */
    public function bind_method_can_bind_to_creator_method()
    {
        $classname = 'temp2';
        $this->container()->bind($classname, function () {
            return Mockery::mock();
        });

        $this->assertIsObject($this->container()->get($classname));
    }

    /**
     * @test
     * @covers \Simplex\Facade\Container::bind
     */
    public function bind_method_is_not_singleton_on_method()
    {
        $classname = 'temp3';
        $this->container()->bind($classname, function () {
            return Mockery::mock();
        });

        $this->assertEquals(
            $this->container()->get($classname),
            $this->container()->get($classname)
        );
    }

    /**
     * @test
     * @covers \Simplex\Facade\Container::bind
     */
    public function bind_method_cannot_bind_to_existing_id()
    {
        $classname = 'temp4';
        $this->container()->bind($classname, function () {
            return Mockery::mock();
        });

        $catched = false;
        try {
            $this->container()->bind($classname, function () {
                return Mockery::mock();
            });
        } catch (ContainerException $e) {
            $catched = true;
        }

        $this->assertTrue($catched);
    }

    /**
     * @test
     * @covers \Simplex\Facade\Container::singleton
     */
    public function singleton_method_is_singleton_with_object()
    {
        $classname = 'temp5';
        $this->container()->singleton($classname, Mockery::mock());

        $this->assertEquals(
            $this->container()->get($classname),
            $this->container()->get($classname)
        );
    }

    /**
     * @test
     * @covers \Simplex\Facade\Container::singleton
     */
    public function singleton_method_is_singleton_with_method()
    {
        $classname = 'temp6';
        $this->container()->singleton($classname, function () {
            return Mockery::mock();
        });

        $this->assertEquals(
            $this->container()->get($classname),
            $this->container()->get($classname)
        );
    }

    /**
     * @test
     * @covers \Simplex\Facade\Container::has
     */
    public function has_method_can_check_id_exists()
    {
        $classname = 'temp7';
        $this->container()->singleton($classname, function () {
            return Mockery::mock();
        });

        $this->assertTrue(
            $this->container()->has($classname)
        );
    }

    /**
     * @test
     * @covers \Simplex\Facade\Container::has
     */
    public function has_method_can_check_id_does_not_exists()
    {
        $classname = 'temp8';
        $this->assertFalse(
            $this->container()->has($classname)
        );
    }

    /**
     * @test
     * @covers \Simplex\Facade\Container::get
     */
    public function get_method_can_get_existing_id()
    {
        $classname = 'temp9';
        $this->container()->singleton($classname, function () {
            return Mockery::mock();
        });

        $this->assertIsObject(
            $this->container()->get($classname)
        );
    }

    /**
     * @test
     * @covers \Simplex\Facade\Container::get
     */
    public function get_method_throw_exception_if_id_does_not_exists()
    {
        $classname = 'temp10';
        $catched = false;
        try {
            $this->container()->get($classname);
        } catch (\Throwable $e) {
            $catched = true;
        }

        $this->assertTrue($catched);
    }
}
