<?php namespace Quasar\OAuth\Services;

use Quasar\OAuth\Services\JWTService;
use Quasar\OAuth\Models\Client;
use Quasar\OAuth\Exceptions\AuthenticationException;

class ClientCredentialsTokenService
{
    public static function getToken(string $clientUuid, string $clientSecret, string $code, string $redirectUri)
    {
        $client = Client::where('uuid', $clientUuid)
                ->where('secret', $clientSecret)
                ->where('redirect', $redirectUri)
                ->where('is_revoked', false)
                ->first();

        if ($client)
        {
            return JWTService::generateAccessToken($client);
        }

        throw new AuthenticationException();
    }
}
