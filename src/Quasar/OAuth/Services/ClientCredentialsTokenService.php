<?php namespace Quasar\OAuth\Services;

use Quasar\OAuth\Services\JWTService;
use Quasar\OAuth\Models\Client;
use Quasar\OAuth\Exceptions\AuthenticationException;

class ClientCredentialsTokenService
{
    public static function getToken(string $clientUuid, string $clientSecret)
    {
        $client = Client::where('uuid', $clientUuid)
                ->where('secret', $clientSecret)
                ->first();

        if ($client)
        {
            return JWTService::generateClientCredentialsAccessTokens($client);
        }

        throw new AuthenticationException();
    }
}
