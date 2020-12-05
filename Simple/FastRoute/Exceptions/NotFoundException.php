<?php

namespace Simple\FastRoute\Exceptions;

class NotFoundException extends HttpException
{
    public static function createWithMessage($path)
    {
        return new self(printf('`%s` Not found.', $path), 404);
    }
}
