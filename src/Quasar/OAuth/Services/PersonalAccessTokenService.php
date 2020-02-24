<?php namespace Quasar\OAuth\Services;

use Illuminate\Support\Facades\Hash;
use Quasar\OAuth\Models\Application;
use Quasar\OAuth\Services\JWTService;
use Quasar\OAuth\Exceptions\AuthenticationException;

class PersonalAccessTokenService
{
    public static function getToken(string $code, string $secret, string $username, string $password)
    {
        // get application
        $application = Application::where('code', $code)->first();

        if ($application && Hash::check($secret, $application->secret))
        {
            // get first personal access client that is not revoked
            $personalAccessClient = $application->clients->where('type_uuid', '974a4a29-92b3-47c3-a282-f2b9058aa273')->where('is_revoke', false)->first();

            // validate username and password
            $entity = self::validateUser($username, $password, $personalAccessClient->model);

            if ($entity && $personalAccessClient)
            {
                return JWTService::generatePersonalAccessTokens($entity->uuid, $personalAccessClient->model, $personalAccessClient);
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
}
