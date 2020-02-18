<?php namespace Quasar\OAuth\Exceptions;

use Exception;

class AuthenticationException extends Exception
{
    protected $message = 'Error to authenticate user';
    protected $code = 401;
}
