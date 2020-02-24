<?php namespace Quasar\OAuth\GraphQL\Resolvers;

use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use GraphQL\Type\Definition\ResolveInfo;
use Quasar\OAuth\Services\AccessTokenService;

class PersonalAccessTokenResolver
{
    public function me($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $accessTokenObj = AccessTokenService::getAccessTokenObject($context->request->bearerToken());
        
        return $accessTokenObj->user;
    }

    public function permissions($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $accessTokenObj = AccessTokenService::getAccessTokenObject($context->request->bearerToken());

       return $accessTokenObj->user->permissions;
    }
}
