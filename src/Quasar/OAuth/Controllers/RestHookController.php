<?php namespace Quasar\OAuth\Controllers;

use Quasar\Core\Controllers\CoreController;
use Quasar\OAuth\Services\RestHookService;
use Quasar\OAuth\Models\RestHook;

class RestHookController extends CoreController
{
    public function __construct(RestHook $model, RestHookService $service)
    {
        $this->model = $model;
        $this->service = $service;
    }
}
