<?php namespace Quasar\OAuth\GraphQL\Resolvers;

use Illuminate\Support\Str;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use GraphQL\Type\Definition\ResolveInfo;
use Quasar\OAuth\Exceptions\AuthenticationException;
use Quasar\OAuth\Services\Grants\AuthorizationCodeService;
use Quasar\OAuth\Services\Grants\ClientCredentialsService;
use Quasar\OAuth\Services\Grants\PasswordGrantService;
use Quasar\OAuth\Services\Grants\RefreshTokenService;
use Quasar\OAuth\Services\JWTService;
use Quasar\OAuth\Support\GrantType;

class CredentialsResolver
{
    public function credentials($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        if ($args['credentials']['grantType'] === GrantType::AUTHORIZATION_CODE)
        {
            return AuthorizationCodeService::getToken($args['credentials']['clientId'], $args['credentials']['clientSecret'], $args['credentials']['code'], $args['credentials']['redirectUri']);
        }

        if ($args['credentials']['grantType'] === GrantType::CLIENT_CREDENTIALS)
        {
            return ClientCredentialsService::getToken($args['credentials']['clientId'], $args['credentials']['clientSecret']);
        }

        if ($args['credentials']['grantType'] === GrantType::PASSWORD)
        {
            if ($context->request->hasHeader('Authorization'))
            {
                $token = Str::after($context->request->header('Authorization'), 'Basic ');
                list($code, $secret) = explode (':', base64_decode($token));
                
                return PasswordGrantService::getToken($code, $secret, $args['credentials']['username'], $args['credentials']['password']);
            }
        }

        if ($args['credentials']['grantType'] === GrantType::REFRESH_TOKEN)
        {
            return RefreshTokenService::getToken($args['credentials']['refreshToken']);
        }
        
        throw new AuthenticationException();
    }

    public function refreshCredentials($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return JWTService::refreshAccessTokens($args['credentials']['refreshToken']);
    }
}
