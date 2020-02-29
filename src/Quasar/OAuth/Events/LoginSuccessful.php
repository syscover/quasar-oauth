<?php namespace Quasar\OAuth\Events;

use Quasar\OAuth\Support\RestHook;

class LoginSuccessful
{
    public $restHookEvent = RestHook::OAUTH_LOGIN_SUCCESSFUL;
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }
}