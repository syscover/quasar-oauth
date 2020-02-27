<?php namespace Quasar\OAuth\GraphQL\Resolvers;

use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use GraphQL\Type\Definition\ResolveInfo;
use Quasar\OAuth\Services\Grants\PasswordGrantService;

class PasswordGrantResolver
{
    public function me($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return PasswordGrantService::me($context->request->bearerToken());
    }

    public function permissions($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
       return PasswordGrantService::permissions($context->request->bearerToken());
    }
}
