<?php namespace Quasar\OAuth\Exceptions;

use Exception;

class ClientNotFoundException extends Exception
{
    protected $message = 'Client not found in our records';
    protected $code = 401;
}
