<?php namespace Quasar\OAuth\Services;

use Illuminate\Support\Str;
use Firebase\JWT\JWT;
use Carbon\Carbon;
use Quasar\OAuth\Services\AccessTokenService;
use Quasar\OAuth\Services\RefreshTokenService;
use Quasar\OAuth\Models\Client;
use Quasar\OAuth\Models\RefreshToken;

class JWTService
{
    /**
     * Generate personal access token
     */
    public static function generatePersonalAccessTokens(
        string $userUuid,
        string $userType,
        Client $client
    )
    {
        // get current times
        $accessTokenDate    = Carbon::now();
        $refreshTokenDate   = Carbon::now();

        // generate access token
        $accessTokenPayload['jit']      = (string) Str::uuid();
        $accessTokenPayload['iss']      = 'Quasar OAuth';
        $accessTokenPayload['iat']      = $accessTokenDate->format('U');
        $accessTokenPayload['nbf']      = $accessTokenDate->format('U');
        $accessTokenPayload['exp']      = $accessTokenDate->addSeconds(config('quasar-oauth.personal_access_token_expiration'))->format('U');
        
        // generate refresh token
        $refreshTokenPayload['jit']     = (string) Str::uuid();
        $refreshTokenPayload['iss']     = 'Quasar OAuth';
        $refreshTokenPayload['iat']     = $refreshTokenDate->format('U');
        $refreshTokenPayload['nbf']     = $refreshTokenDate->format('U');
        $refreshTokenPayload['exp']     = $refreshTokenDate->addSeconds(config('quasar-oauth.personal_refresh_token_expiration'))->format('U');

        // generate tokens
        $accessToken    = self::encode($accessTokenPayload, $client->secret);
        $refreshToken   = self::encode($refreshTokenPayload, $client->secret);

        $accessTokenService = new AccessTokenService();
        $refreshTokenService = new RefreshTokenService();

        // register tokens
        $accessTokenService->create([
            'uuid'          => $accessTokenPayload['jit'],
            'clientUuid'    => $client->uuid,
            'token'         => $accessToken,
            'isRevoked'     => false,
            'name'          => $client->name,
            'userUuid'      => $userUuid,
            'userType'      => $userType,
            'expiresAt'     => $accessTokenDate->toDateTimeString()
        ]);

        $refreshTokenService->create([
            'uuid'              => $refreshTokenPayload['jit'],
            'accessTokenUuid'   => $accessTokenPayload['jit'],
            'token'             => $refreshToken,
            'isRevoked'         => false,
            'expiresAt'         => $refreshTokenDate->toDateTimeString()
        ]);

        return [
            'accessToken'   => $accessToken,
            'refreshToken'  => $refreshToken
        ];
    }

    /**
     * Generate access token from refresh token
     */
    public static function generatePersonalAccessTokensWithRefreshToken(
        string $refreshToken, 
        string $grantType
    )
    {
        // get refresh token without sign
        $refreshTokenArr = (array) self::decode($refreshToken);

        // get refresh token from uuid
        $refreshTokenObj = RefreshToken::where('uuid', $refreshTokenArr['jit'])->first();

        // get access token
        $accessToken = $refreshTokenObj->accessToken;

        // decode refresh token with sign
        self::decode($refreshToken, $accessToken->client->secret);
        
        // delete old access token and refresh token by foreign key
        $accessToken->delete();

        return self::generatePersonalAccessTokens(
            $accessToken->userUuid, 
            $accessToken->userType,
            $accessToken->client
        );
    }

    /**
     * Generate client credentials access token
     */
    public static function generateClientCredentialsAccessTokens(
        Client $client
    )
    {
        // get current times
        $accessTokenDate    = Carbon::now();
        $refreshTokenDate   = Carbon::now();

        // generate access token
        $accessTokenPayload['jit']      = (string) Str::uuid();
        $accessTokenPayload['iss']      = 'Quasar OAuth';
        $accessTokenPayload['iat']      = $accessTokenDate->format('U');
        $accessTokenPayload['nbf']      = $accessTokenDate->format('U');
        $accessTokenPayload['exp']      = $accessTokenDate->addSeconds(config('quasar-oauth.client_credentials_token_expiration'))->format('U');
        
        // generate token
        $accessToken = self::encode($accessTokenPayload, $client->secret);

        $accessTokenService = new AccessTokenService();

        // register token
        $accessTokenService->create([
            'uuid'          => $accessTokenPayload['jit'],
            'clientUuid'    => $client->uuid,
            'token'         => $accessToken,
            'isRevoked'     => false,
            'name'          => $client->name,
            'expiresAt'     => $accessTokenDate->toDateTimeString()
        ]);

        return [
            'accessToken'   => $accessToken
        ];
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
