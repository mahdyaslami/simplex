<?php

namespace SimpleTests;

use Simple\Test\TestCase;

final class HelperTest extends TestCase
{
    /**
     * @test
     * @covers ::base_path
     */
    public function base_path_will_concate_path()
    {
        $GLOBALS['BASE_PATH'] = '/base_path';

        $this->assertEquals('/base_path' . DIRECTORY_SEPARATOR . 'path', base_path('path'), 'Path does not concated.');
    }

    /**
     * @test
     * @covers ::base_path
     */
    public function does_not_have_trailing_slash_when_path_is_empty()
    {
        $GLOBALS['BASE_PATH'] = '/base_path';

        $this->assertEquals('/base_path', base_path(), 'Trailing slash with emtpy path not allowed.');
    }
}
