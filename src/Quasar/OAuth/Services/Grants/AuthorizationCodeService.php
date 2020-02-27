<?php namespace Quasar\OAuth\Services\Grants;

use Illuminate\Database\Eloquent\Builder;
use Quasar\OAuth\Services\JWTService;
use Quasar\OAuth\Models\Client;
use Quasar\OAuth\Exceptions\AuthenticationException;

class AuthorizationCodeService
{
    public static function getToken(string $clientUuid, string $clientSecret, string $code, string $redirect)
    {
        $client = Client::where('uuid', $clientUuid)
                ->where('secret', $clientSecret)
                ->where('redirect', $redirect)
                ->where('is_revoked', false)
                ->where('grant_type_uuid', 'd05ab246-28d5-4248-92ee-6e37b9a02f46')
                ->whereHas('authorizationCodes', function (Builder $query) {
                    $query->where('is_revoked', false)
                        ->where('expires_at', '>', now())
                        ->where('code', $code);
                })
                ->first();

        if ($client)
        {
            return JWTService::generateAccessToken($client);
        }

        throw new AuthenticationException();
    }
}
