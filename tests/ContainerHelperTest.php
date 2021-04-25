<?php

namespace Tests;

use League\Container\Container;
use Mockery;
use Simplex\Test\TestCase;

final class ContainerHelperTest extends TestCase
{
    /**
     * @test
     * @covers ::container
     */
    public function get_container_when_global_is_null()
    {
        $GLOBALS['container'] = null;

        $this->assertInstanceOf(Container::class, container(), 'container function should return a Container.');
    }

    /**
     * @test
     * @covers ::container
     */
    public function get_container_when_global_has_value()
    {
        $GLOBALS['container'] = new Container();

        $this->assertInstanceOf(Container::class, container(), 'container function should return a Container.');
    }

    /**
     * @test
     * @covers ::resolve
     */
    public function resolve_should_call_get_method()
    {
        $mock = Mockery::mock(Container::class);
        $mock->shouldReceive('get')->once();

        $GLOBALS['container'] = $mock;

        resolve('temp');

        Mockery::close();

        $this->assertTrue(true);
    }
}
