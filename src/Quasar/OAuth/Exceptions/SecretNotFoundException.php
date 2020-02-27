<?php namespace Quasar\OAuth\Exceptions;

use Exception;

class SecretNotFoundException extends Exception
{
    protected $message = 'Secret not found in client object';
    protected $code = 401;
}
