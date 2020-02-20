<?php namespace Quasar\OAuth\GraphQL\Resolvers;

use Quasar\OAuth\Models\Application;
use Quasar\OAuth\Services\ApplicationService;
use Quasar\Core\GraphQL\Resolvers\CoreResolver;

class ApplicationResolver extends CoreResolver
{
    public function __construct(Application $model, ApplicationService $service)
    {
        $this->model = $model;
        $this->service = $service;
    }
}
