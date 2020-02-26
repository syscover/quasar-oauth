<?php namespace Quasar\OAuth\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Quasar\Core\Traits\ApiRestResponse;
use Quasar\OAuth\Models\Client;
use Quasar\OAuth\Services\ClientCredentialsTokenService;
use Quasar\OAuth\Support\GrantType;
use Quasar\OAuth\Exceptions\AuthenticationException;

class CredentialsController extends BaseController
{
    use ApiRestResponse;

    public function token(Request $request)
    {
        $grantType = $request->input('grant_type');
        $data = [];

        if ($grantType === GrantType::AUTHORIZATION_CODE)
        {
            // check code
            $client = Client::where('uuid', $request->input('client_id'))
                ->where('client_secret', $request->input('client_id'))
                ->where('is_revoked', false)
                ->first();

            if ($client)
            {
                
            }

        }
        
        if ($grantType === GrantType::CLIENT_CREDENTIALS)
        {
            $data = ClientCredentialsTokenService::getToken($request->input('client_id'), $request->input('client_secret'));

            return $this->successResponse($data);
        }
    }

    public function refreshToken(Request $request)
    {
        $grantType = $request->input('grant_type');
        $data = [];

        if ($grantType === GrantType::REFRESH_TOKEN)
        {
            
        }
    }

    public function authorize(Request $request)
    {
        $client = Client::where('uuid', $request->input('client_id'))
            ->where('is_revoked', false)
            ->first();

        $request->input('response_type'); // code
        
       // dd($request->all());

        if ($client)
        {
            return view('oauth::pages.authorize', [
                'client'    => $client,
                'scopes'    => [],
                'code'      => '123456789',
                'request'   => $request
            ]);
        }

        throw new AuthenticationException();
    }
}
