<?php

namespace Simple\FastRoute\Exceptions;

class MethodNotAllowedException extends HttpException 
{
  public static function createWithMessage($method, $path)
  {
        return new self(sprintf('`%s` method not allowed for `%s` path.', $method, $path), 405);
  }
}
