<?php namespace Quasar\OAuth\Listeners;

use Quasar\OAuth\Events\LoginSuccessful;
use Quasar\OAuth\Traits\RestHookable;

class LoginSuccessfulListener
{
    use RestHookable;

    public function handle(LoginSuccessful $event)
    {
        $this->restHook->fire($event->restHookEvent, $event->user);
    }
}