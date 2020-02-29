<?php namespace Quasar\OAuth\Traits;

use Quasar\OAuth\Support\RestHook;

trait RestHookable
{
    protected $restHook;

    public function __construct(RestHook $restHook)
    {
        $this->restHook = $restHook;
    }
}