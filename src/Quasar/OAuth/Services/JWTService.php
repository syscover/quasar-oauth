<?php namespace Quasar\OAuth\Services;

use Illuminate\Support\Str;
use Firebase\JWT\JWT;
use Carbon\Carbon;
use Quasar\OAuth\Exceptions\RefreshTokenExpiredException;
use Quasar\OAuth\Services\AccessTokenService;
use Quasar\OAuth\Services\RefreshTokenService;
use Quasar\OAuth\Models\Client;
use Quasar\OAuth\Models\RefreshToken;

class JWTService
{
    /**
     * Generate client credentials access token
     */
    public static function generateAccessToken(Client $client, string $userType = null, string $userUuid = null)
    {
        // defined tokens
        $accessToken    = null;
        $refreshToken   = null;

        // Access Token
        // get current time
        $accessTokenDate = Carbon::now();
        
        // generate access token
        $accessTokenPayload['jit']      = (string) Str::uuid();
        $accessTokenPayload['iss']      = 'Quasar OAuth';
        $accessTokenPayload['iat']      = $accessTokenDate->format('U');
        $accessTokenPayload['nbf']      = $accessTokenDate->format('U');
        if ($client->expiredAccessToken) $accessTokenPayload['exp'] = $accessTokenDate->addSeconds($client->expiredAccessToken)->format('U');

        // generate token
        $accessToken            = self::encode($accessTokenPayload, $client->secret);
        (new AccessTokenService)->create([
            'uuid'          => $accessTokenPayload['jit'],
            'clientUuid'    => $client->uuid,
            'token'         => $accessToken,
            'isRevoked'     => false,
            'name'          => $client->name,
            'userType'      => $userType ? $userType : null,
            'userUuid'      => $userUuid ? $userUuid : null,
            'expiresAt'     => $client->expiredAccessToken ? $accessTokenDate->toDateTimeString() : null
        ]);

        // Refresh Token
        if ($client->expiredAccessToken && $client->expiredAccessToken)
        {
            // get current time
            $refreshTokenDate   = Carbon::now();

            // generate refresh token
            $refreshTokenPayload['jit']     = (string) Str::uuid();
            $refreshTokenPayload['iss']     = 'Quasar OAuth';
            $refreshTokenPayload['iat']     = $refreshTokenDate->format('U');
            $refreshTokenPayload['nbf']     = $refreshTokenDate->format('U');
            $refreshTokenPayload['exp']     = $refreshTokenDate->addSeconds($client->expiredRefreshToken)->format('U');

            // generate token
            $refreshToken           = self::encode($refreshTokenPayload, $client->secret);
            (new RefreshTokenService)->create([
                'uuid'              => $refreshTokenPayload['jit'],
                'accessTokenUuid'   => $accessTokenPayload['jit'],
                'token'             => $refreshToken,
                'isRevoked'         => false,
                'expiresAt'         => $refreshTokenDate->toDateTimeString()
            ]);
        }
        
        // build response
        $response = [];
        $response['token_type']     = 'bearer';
        $response['access_token']   = $accessToken;
        if ($refreshToken) $response['refresh_token'] = $refreshToken;
        if ($client->expiredRefreshToken) $response['expires_in'] = $client->expiredRefreshToken;
        $response['scope']          = '*';
        
        return $response;
    }

    /**
     * Refresh access token with refresh token
     */
    public static function refreshAccessTokens(string $refreshToken)
    {
        // get refresh token without sign
        $refreshTokenArr = (array) self::decode($refreshToken);

        // get refresh token from uuid
        $refreshTokenObj = RefreshToken::where('uuid', $refreshTokenArr['jit'])->first();

        // get access token
        $accessToken = $refreshTokenObj->accessToken;

        // check that refresh token isn't expired
        if (Carbon::parse($refreshTokenObj->expiresAt) < now()) throw new RefreshTokenExpiredException();

        // decode refresh token with sign
        self::decode($refreshToken, $accessToken->client->secret);
        
        // delete old access token and refresh token by foreign key
        $accessToken->delete();

        return self::generateAccessToken($accessToken->client, $accessToken->userType, $accessToken->userUuid);
    }

    public static function encode(array $payload, string $secret)
    {
        return JWT::encode($payload, $secret, 'HS256');
    }

    public static function decode(string $jwt, string $secret = null)
    {
        if ($secret) return JWT::decode($jwt, $secret, ['HS256']);

        list($header, $payload, $signature) = explode ('.', $jwt);
        
        return json_decode(base64_decode($payload));
    }
}
