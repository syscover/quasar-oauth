<?php namespace Quasar\OAuth\Services\Grants;

use Illuminate\Support\Facades\Hash;
use Quasar\OAuth\Models\Application;
use Quasar\OAuth\Exceptions\AuthenticationException;
use Quasar\OAuth\Services\JWTService;
use Quasar\OAuth\Services\AccessTokenService;

class PasswordGrantService
{
    public static function getToken(string $code, string $secret, string $username, string $password)
    {
        // get application
        $application = Application::where('code', $code)->first();

        if ($application && Hash::check($secret, $application->secret))
        {
            // get first personal access client that is not revoked
            $client = $application->clients
                ->where('grant_type_uuid', 'a48e6aa0-2e9a-492d-b63b-d5b6223e74e2')
                ->where('is_revoke', false)
                ->first();

            // validate username and password
            $entity = self::validateUser($username, $password, $client->model);

            if ($entity && $client)
            {
                return JWTService::generateAccessToken($client, $client->model, $entity->uuid);
            }
        }

        throw new AuthenticationException();
    }

    public static function validateUser(string $username, string $password, string $model)
    {
        $entity = $model::where('username', $username)->first();

        if ($entity && Hash::check($password, $entity->password)) return $entity;

        return null;
    }

    public static function me(string $bearerToken)
    {
        $accessTokenObj = AccessTokenService::getAccessTokenObject($bearerToken);
        
        return $accessTokenObj->user;
    }

    public static function permissions(string $bearerToken)
    {
        $accessTokenObj = AccessTokenService::getAccessTokenObject($bearerToken);

       return $accessTokenObj->user->permissions;
    }
}
