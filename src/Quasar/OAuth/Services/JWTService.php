<?php namespace Quasar\OAuth\Services;

use Illuminate\Support\Str;
use Firebase\JWT\JWT;
use Carbon\Carbon;
use Quasar\OAuth\Services\AccessTokenService;
use Quasar\OAuth\Services\RefreshTokenService;
use Quasar\OAuth\Models\Client;

class JWTService
{
    /**
     * Generate access token
     */
    public static function generatePersonalAccessTokens(
        string $userUuid,
        string $userType,
        array $accessTokenPayload, 
        array $refreshTokenPayload
    )
    {
        // get current time
        $date = Carbon::now();

        $client = Client::where('type_uuid', '974a4a29-92b3-47c3-a282-f2b9058aa273')->first();

        // generate access token
        $accessTokenPayload['jit']      = Str::uuid();
        $accessTokenPayload['iss']      = 'Quasar OAuth';
        $accessTokenPayload['iat']      = $date->format('U');
        $accessTokenPayload['nbf']      = $date->format('U');
        $accessTokenPayload['exp']      = $date->addSeconds(config('quasar.oauth.personal_access_token_expiration'))->format('U');
        
        // generate refresh token
        $refreshTokenPayload['jit']     = Str::uuid();
        $refreshTokenPayload['iss']     = 'Quasar OAuth';
        $refreshTokenPayload['iat']     = $date->format('U');
        $refreshTokenPayload['nbf']     = $date->format('U');
        $refreshTokenPayload['exp']     = $date->addSeconds(config('quasar.oauth.personal_refresh_token_expiration'))->format('U');

        // generate tokens
        $accessToken    = self::encode($accessTokenPayload, $client->secret);
        $refreshToken   = self::encode($refreshTokenPayload, $client->secret);

        // register tokens
        AccessTokenService::create([
            'uuid'          => $accessTokenPayload['jit'],
            'clientUuid'    => $client->uuid,
            'token'         => $accessToken,
            'isRevoked'     => false,
            'name'          => $client->name,
            'userUuid'      => $userUuid,
            'userType'      => $userType,
            'expiresAt'     => $date->toDateTimeString()
        ]);

        RefreshTokenService::create([
            'uuid'              => $refreshTokenPayload['jit'],
            'accessTokenUuid'   => $refreshTokenPayload['jit'],
            'token'             => $refreshToken,
            'isRevoked'         => false,
            'expires_at'        => $date->toDateTimeString()
        ]);

        return [
            'accessToken'   => $accessToken,
            'refreshToken'  => $refreshToken
        ];
    }

    public static function encode(array $payload, string $secret)
    {
        return JWT::encode($encode, $secret, 'HS256');
    }

    public static function decode(string $jwt, string $secret)
    {
        return JWT::decode($jwt, $secret, ['HS256']);
    }
}
