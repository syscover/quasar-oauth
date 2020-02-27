<?php namespace Quasar\OAuth\Exceptions;

use Exception;

class RefreshTokenExpiredException extends Exception
{
    protected $message = 'Refresh token has expired';
    protected $code = 401;
}
