<?php namespace Quasar\OAuth\Exceptions;

use Exception;

class JWTRejectedException extends Exception
{
    protected $message = 'JWT is not valid';
    protected $code = 401;
}
