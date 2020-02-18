<?php namespace Quasar\OAuth\GraphQL\Resolvers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use GraphQL\Type\Definition\ResolveInfo;
use Quasar\OAuth\Exceptions\AuthenticationException;
use Quasar\OAuth\Services\PersonalAccessTokenService;
use Quasar\OAuth\Services\JWTService;
use Quasar\OAuth\Services\AccessTokenService;
use Quasar\OAuth\Models\Application;

class PersonalAccessTokenResolver
{
    public function credentials($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        if ($context->request->hasHeader('Authorization'))
        {
            $token = Str::after($context->request->header('Authorization'), 'Basic ');
            list($code, $secret) = explode (':', base64_decode($token));
            
            // get application
            $application = Application::where('code', $code)->first();

            if ($application && Hash::check($secret, $application->secret))
            {
                $entity = PersonalAccessTokenService::validateUser($args['credentials']['username'], $args['credentials']['password'], $application->model);

                // get first personal access client that is not revoked
                $personalAccessClient = $application->clients->where('type_uuid', '974a4a29-92b3-47c3-a282-f2b9058aa273')->where('is_revoke', false)->first();

                if ($entity)
                {
                    return JWTService::generatePersonalAccessTokens($entity->uuid, $application->model, $personalAccessClient);
                }
            }
        }

        throw new AuthenticationException();
    }

    public function refreshCredentials($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return JWTService::generatePersonalAccessTokensWithRefreshToken($args['credentials']['refreshToken'], $args['credentials']['grantType']);
    }

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
