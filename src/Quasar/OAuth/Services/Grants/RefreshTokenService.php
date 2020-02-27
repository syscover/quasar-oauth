<?php namespace Quasar\OAuth\Services\Grants;

use Quasar\OAuth\Services\JWTService;

class RefreshTokenService
{
    public static function getToken(string $refreshToken)
    {
        return JWTService::refreshAccessTokens($refreshToken);
    }
}
