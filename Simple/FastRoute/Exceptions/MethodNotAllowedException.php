<?php

namespace Simple\FastRoute\Exceptions;

class MethodNotAllowedException extends HttpException
{
    public static function createWithMessage($method, $path)
    {
        return new self(printf('`%s` method not allowd for `%s` path.', $method, $path), 405);
    }
}
