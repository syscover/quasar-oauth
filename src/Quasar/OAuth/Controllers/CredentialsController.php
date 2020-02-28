<?php namespace Quasar\OAuth\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Quasar\OAuth\Models\Client;
use Quasar\OAuth\Services\Grants\AuthorizationCodeService;
use Quasar\OAuth\Services\Grants\ClientCredentialsService;
use Quasar\OAuth\Services\Grants\PasswordGrantService;
use Quasar\OAuth\Services\Grants\RefreshTokenService;
use Quasar\OAuth\Services\AuthorizationCodeService as CodeService;
use Quasar\OAuth\Support\GrantType;
use Quasar\OAuth\Exceptions\AuthenticationException;

class CredentialsController extends BaseController
{
    public function credentials(Request $request)
    {
        $grantType = $request->input('grant_type');
        $data = [];

        if ($grantType === GrantType::AUTHORIZATION_CODE)
        {
            $data = AuthorizationCodeService::getToken($request->input('client_id'), $request->input('client_secret'), $request->input('code'), $request->input('redirect_uri'));

            return response()->json($data, 200);
        }
        
        if ($grantType === GrantType::CLIENT_CREDENTIALS)
        {
            $data = ClientCredentialsService::getToken($request->input('client_id'), $request->input('client_secret'));

            return response()->json($data, 200);
        }

        if ($grantType === GrantType::PASSWORD)
        {
            if ($request->hasHeader('Authorization'))
            {
                $token = Str::after($request->header('Authorization'), 'Basic ');
                list($code, $secret) = explode (':', base64_decode($token));
                
                $data = PasswordGrantService::getToken($code, $secret, $request->input('username'), $request->input('password'));

                return response()->json($data, 200);
            }            
        }

        if ($grantType === GrantType::REFRESH_TOKEN)
        {
            $data = RefreshTokenService::getToken($request->input('refresh_token'));

            return response()->json($data, 200);
        }
    }

    public function authorize(Request $request)
    {
        if ($request->input('response_type') === 'code')
        {
            $client = Client::where('uuid', $request->input('client_id'))
            ->where('is_revoked', false)
            ->first();

            if ($client)
            {
                return view('oauth::pages.authorize', [
                    'client'    => $client,
                    'scopes'    => [],
                    'code'      => CodeService::getCode($client->uuid),
                    'request'   => $request
                ]);
            }
        }
        
        throw new AuthenticationException();
    }
}
