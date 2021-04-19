<?php

namespace Tests\Test;

use Psr\Http\Message\ServerRequestInterface;
use Simplex\Test\TestCase;
use Simplex\Http\RequestFactory;

final class ReqeustFactoryTest extends TestCase
{
    /**
     * @test
     * @covers \Simplex\Http\RequestFactory
     */
    public function app_generate_request_and_call_request_handler()
    {
        $requestFactory = new RequestFactory();

        $this->assertInstanceOf(
            ServerRequestInterface::class,
            $requestFactory->generate(),
            'Request factory should return instace of ServerRequestInterface.'
        );
    }
}
