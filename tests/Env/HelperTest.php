<?php

namespace Tests\Env;

use Simple\Test\TestCase;

final class HelperTest extends TestCase
{
    /**
     * @test
     * @covers ::env
     */
    public function set_env_with_uppercase_and_get_with_customcase()
    {
        $value = 'aslami';
        $key = 'ENV';

        env($key, $value);

        $this->assertEquals($value, env('ENV'), 'Error in setting uppercase key and get by uppercase key.');

        $this->assertEquals($value, env('env'), 'Error in setting uppercase key and get by lowercase key.');

        $this->assertEquals($value, env('eNv'), 'Error in setting uppercase key and get by customcase key.');
    }

    /**
     * @test
     * @covers ::env
     */
    public function set_env_with_lowercase_and_get_with_customcase()
    {
        $value = 'aslami';
        $key = 'env';

        env($key, $value);

        $this->assertEquals($value, env('ENV'), 'Error in setting lowercase key and get by uppercase key.');

        $this->assertEquals($value, env('env'), 'Error in setting lowercase key and get by lowercase key.');

        $this->assertEquals($value, env('eNv'), 'Error in setting lowercase key and get by customcase key.');
    }

    /**
     * @test
     * @covers ::env
     */
    public function set_env_with_customcase_and_get_with_customcase()
    {
        $value = 'aslami';
        $key = 'eNv';

        env($key, $value);

        $this->assertEquals($value, env('ENV'), 'Error in setting customcase key and get by uppercase key.');

        $this->assertEquals($value, env('env'), 'Error in setting customcase key and get by lowercase key.');

        $this->assertEquals($value, env('EnV'), 'Error in setting customcase key and get by customcase key.');
    }
}
