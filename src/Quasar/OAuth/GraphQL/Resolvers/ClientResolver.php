<?php namespace Quasar\OAuth\GraphQL\Resolvers;

use Quasar\OAuth\Models\Client;
use Quasar\OAuth\Services\ClientService;
use Quasar\Core\GraphQL\Resolvers\CoreResolver;

class ClientResolver extends CoreResolver
{
    public function __construct(Client $model, ClientService $service)
    {
        $this->model = $model;
        $this->service = $service;
    }
}
