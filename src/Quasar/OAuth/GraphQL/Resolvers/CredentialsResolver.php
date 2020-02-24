<?php namespace Quasar\OAuth\GraphQL\Resolvers;

use Illuminate\Support\Str;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use GraphQL\Type\Definition\ResolveInfo;
use Quasar\OAuth\Exceptions\AuthenticationException;
use Quasar\OAuth\Services\PersonalAccessTokenService;
use Quasar\OAuth\Services\JWTService;
use Quasar\OAuth\Support\GrantType;

class CredentialsResolver
{
    public function credentials($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        if ($args['credentials']['grantType'] === GrantType::CLIENT_CREDENTIALS)
        {

        }

        if ($args['credentials']['grantType'] === GrantType::PASSWORD)
        {
            if ($context->request->hasHeader('Authorization'))
            {
                $token = Str::after($context->request->header('Authorization'), 'Basic ');
                list($code, $secret) = explode (':', base64_decode($token));
                
                return PersonalAccessTokenService::getToken($code, $secret, $args['credentials']['username'], $args['credentials']['password']);
            }
        }
        
        throw new AuthenticationException();
    }

    public function refreshCredentials($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return JWTService::generatePersonalAccessTokensWithRefreshToken($args['credentials']['refreshToken'], $args['credentials']['grantType']);
    }
}
