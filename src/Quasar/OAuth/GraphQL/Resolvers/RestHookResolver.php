<?php namespace Quasar\OAuth\GraphQL\Resolvers;

use Quasar\OAuth\Models\RestHook;
use Quasar\OAuth\Services\RestHookService;
use Quasar\Core\GraphQL\Resolvers\CoreResolver;

class RestHookResolver extends CoreResolver
{
    public function __construct(RestHook $model, RestHookService $service)
    {
        $this->model = $model;
        $this->service = $service;
    }
}
