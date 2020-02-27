<?php namespace Quasar\OAuth\Services\Grants;

use Quasar\OAuth\Services\JWTService;
use Quasar\OAuth\Models\Client;
use Quasar\OAuth\Exceptions\AuthenticationException;

class ClientCredentialsService
{
    public static function getToken(string $clientUuid, string $clientSecret)
    {
        $client = Client::where('uuid', $clientUuid)
                ->where('secret', $clientSecret)
                ->where('is_revoked', false)
                ->first();

        if ($client)
        {
            return JWTService::generateAccessToken($client);
        }

        throw new AuthenticationException();
    }
}
