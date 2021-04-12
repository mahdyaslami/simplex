<?php

namespace Tests\Test;

use Simple\Test\TestCase;

final class TestCaseTest extends TestCase
{
    /**
     * @test
     * @covers \Simple\Test\TestCase
     */
    public function check_get_fill_request_uri_and_request_method()
    {
        $this->get('/test');

        $this->assertEquals('GET', $_SERVER['REQUEST_METHOD']);
        $this->assertEquals('/test', $_SERVER['REQUEST_URI']);
    }

    /**
     * @test
     * @covers \Simple\Test\TestCase
     */
    public function check_post_fill_request_uri_and_request_method()
    {
        $this->post('/test');

        $this->assertEquals('POST', $_SERVER['REQUEST_METHOD']);
        $this->assertEquals('/test', $_SERVER['REQUEST_URI']);
    }
}
