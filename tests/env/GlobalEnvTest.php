<?php

use Simple\Env\Provider;
use Simple\Test\TestCase;

final class GlobalEnvTest extends TestCase
{
    protected function setUp(): void
    {
        file_put_contents(
            base_path('env.php'),
            "<?php return [
                'UPPERCASE' => 'value',
                'lowercase' => 'value',
                'CustomCase' => 'value'
            ];"
        );

        Provider::create(base_path('env.php'))->register();
    }

    protected function tearDown(): void
    {
        unlink(base_path('env.php'));
    }

    /**
     * @test
     */
    public function get_uppercase()
    {
        $this->assertTrue(isset($_ENV['UPPERCASE']), 'Error in setting uppercase key and in env file.');

        $this->assertFalse(isset($_ENV['uppercase']), 'Error in setting uppercase key and in env file with lowwercase.');

        $this->assertFalse(isset($_ENV['UpperCase']), 'Error in setting uppercase key and in env file with customcase.');
    }

    /**
     * @test
     */
    public function get_lowercase()
    {
        $this->assertTrue(isset($_ENV['LOWERCASE']), 'Error in setting lowercase key and in env file.');

        $this->assertFalse(isset($_ENV['lowercase']), 'Error in setting lowercase key and in env file with lowwercase.');

        $this->assertFalse(isset($_ENV['LowerCase']), 'Error in setting lowercase key and in env file with customcase.');
    }

    /**
     * @test
     */
    public function get_customcase()
    {
        $this->assertTrue(isset($_ENV['CUSTOMCASE']), 'Error in setting customcase key and in env file.');

        $this->assertFalse(isset($_ENV['customcase']), 'Error in setting customcase key and in env file with lowwercase.');

        $this->assertFalse(isset($_ENV['CustomCase']), 'Error in setting customcase key and in env file with customcase.');
    }
}
