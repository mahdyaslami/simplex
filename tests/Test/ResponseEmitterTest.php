<?php

namespace Tests\Test;

ob_start();

use Laminas\Diactoros\Response;
use Simplex\Test\TestCase;
use Simplex\Http\ResponseEmitter;

final class ResponseEmitterTest extends TestCase
{
    /**
     * @test
     * @covers \Simplex\Http\ResponseEmitter
     */
    public function emit_successfully()
    {
        ob_start();

        (new ResponseEmitter)->emit(new Response('body', 200, [
            'Content-type' => 'application/json'
        ]));

        ob_end_flush();

        $this->assertTrue(True);
    }
}
