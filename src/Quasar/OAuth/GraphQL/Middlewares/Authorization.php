<?php namespace Quasar\OAuth\GraphQL\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Quasar\OAuth\Services\JWTService;
use Quasar\OAuth\Models\AccessToken;
use Quasar\OAuth\Exceptions\JWTRejectedException;

class Authorization
{
    private $mutationOAuthCredentials           = 'mutationOAuthCredentials($credentials:OAuthCredentialsInput!){oAuthCredentials(credentials:$credentials){accessTokenrefreshToken__typename}}';
    private $mutationOAuthRefreshCredentials    = 'mutationOAuthRefreshCredentials($credentials:OAuthRefreshCredentialsInput!){oAuthRefreshCredentials(credentials:$credentials){accessTokenrefreshToken__typename}}';

    /**
     * Force the Accept header of the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (
            preg_replace( "/\s+|\r|\n/", "", $request['query']) !== $this->mutationOAuthCredentials && 
            preg_replace( "/\s+|\r|\n/", "", $request['query']) !== $this->mutationOAuthRefreshCredentials
        )
        {
            if (!$request->bearerToken()) throw new JWTRejectedException();

            $token          = (array) JWTService::decode($request->bearerToken());
            $accessToken    = AccessToken::where('uuid', $token['jit'])->first();

            if (!$accessToken || !$accessToken->client || !$accessToken->client->secret) throw new JWTRejectedException();

            // try decode token with sign
            JWTService::decode($request->bearerToken(), $accessToken->client->secret);
        }
        
        return $next($request);
    }
}
