<?php

namespace Tests;

use Mockery;
use Simplex\Facade\Container;
use Simplex\Test\TestCase;

final class ContainerHelperTest extends TestCase
{
    /**
     * @test
     * @covers ::container
     * @covers \Simplex\Facade\Container::getInstance
     * @covers \Simplex\Facade\Container::__construct
     */
    public function get_container_instance()
    {
        $this->assertInstanceOf(Container::class, container(), 'container function should return a Container.');
    }

    /**
     * @test
     * @covers ::resolve
     * @covers \Simplex\Facade\Container::getInstance
     * @covers \Simplex\Facade\Container::__construct
     */
    public function resolve_should_call_get_method()
    {
        $mock = Mockery::mock();

        container()->bind('temp', $mock);

        $this->assertEquals($mock, resolve('temp'), 'Returned object does not true.');

        Mockery::close();

        $this->assertTrue(true);
    }
}
