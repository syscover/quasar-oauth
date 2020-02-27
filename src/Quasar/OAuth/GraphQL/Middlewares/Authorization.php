<?php namespace Quasar\OAuth\GraphQL\Middlewares;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Quasar\OAuth\Services\JWTService;
use Quasar\OAuth\Models\AccessToken;
use Quasar\OAuth\Exceptions\JWTRejectedException;

class Authorization
{
    private $mutationOAuthCredentials           = 'mutationOAuthCredentials($credentials:OAuthCredentialsInput!){oAuthCredentials(credentials:$credentials){access_tokenrefresh_token__typename}}';
    private $mutationOAuthRefreshCredentials    = 'mutationOAuthRefreshCredentials($credentials:OAuthRefreshCredentialsInput!){oAuthRefreshCredentials(credentials:$credentials){access_tokenrefresh_token__typename}}';

    /**
     * Force the Accept header of the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (
            preg_replace( "/\s+|\r|\n/", "", $request['query']) !== $this->mutationOAuthCredentials && 
            preg_replace( "/\s+|\r|\n/", "", $request['query']) !== $this->mutationOAuthRefreshCredentials
        )
        {
            if (!$request->bearerToken()) throw new JWTRejectedException();

            $token = (array) JWTService::decode($request->bearerToken());
            
            if (!isset($token['jit'])) throw new JWTRejectedException();
            
            // get access token from database
            $accessToken = AccessToken::where('uuid', $token['jit'])
                ->where('is_revoked', false)
                ->first();

            // check access token client and client secret
            if (!$accessToken || !$accessToken->client || !$accessToken->client->secret) throw new JWTRejectedException();

            // check if access token has expired
            if ($accessToken->expiresAt)
            {
                if (Carbon::parse($accessToken->expiresAt) < now()) throw new JWTRejectedException();
            }
            
            // try decode token with sign
            JWTService::decode($request->bearerToken(), $accessToken->client->secret);
        }
        
        return $next($request);
    }
}
