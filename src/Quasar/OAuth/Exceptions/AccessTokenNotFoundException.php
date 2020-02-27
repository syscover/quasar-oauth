<?php namespace Quasar\OAuth\Exceptions;

use Exception;

class AccessTokenNotFoundException extends Exception
{
    protected $message = 'Access token not found in our records';
    protected $code = 401;
}
