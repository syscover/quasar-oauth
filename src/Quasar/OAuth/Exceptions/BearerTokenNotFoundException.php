<?php namespace Quasar\OAuth\Exceptions;

use Exception;

class BearerTokenNotFoundException extends Exception
{
    protected $message = 'Bearer token not found in headers';
    protected $code = 401;
}
