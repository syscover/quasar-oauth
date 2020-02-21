<?php namespace Quasar\OAuth\GraphQL\Resolvers;

use Quasar\OAuth\Models\AccessToken;
use Quasar\OAuth\Services\AccessTokenService;
use Quasar\Core\GraphQL\Resolvers\CoreResolver;

class AccessTokenResolver extends CoreResolver
{
    public function __construct(AccessToken $model, AccessTokenService $service)
    {
        $this->model = $model;
        $this->service = $service;
    }
}
