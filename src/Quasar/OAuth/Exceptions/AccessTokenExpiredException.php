<?php namespace Quasar\OAuth\Exceptions;

use Exception;

class AccessTokenExpiredException extends Exception
{
    protected $message = 'Access token has expired';
    protected $code = 401;
}
