<?php namespace Quasar\OAuth\Listeners;

use Quasar\OAuth\Traits\RestHookable;
use Quasar\OAuth\Events\LoginSuccessful;

class LoginSuccessfulListener
{
    use RestHookable;

    public function handle(LoginSuccessful $event)
    {
        $this->restHook->fire($event->restHookEvent, $event->user);
    }
}