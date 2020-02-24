<?php namespace Quasar\OAuth\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Quasar\Core\Traits\ApiRestResponse;
use Quasar\OAuth\Support\GrantType;
use Quasar\OAuth\Services\ClientCredentialsTokenService;

class CredentialsController extends BaseController
{
    use ApiRestResponse;

    public function getToken(Request $request)
    {
        $grantType = $request->input('grantType');
        $data = [];
        
        if ($grantType === GrantType::CLIENT_CREDENTIALS)
        {
            $data = ClientCredentialsTokenService::getToken($request->input('clientUuid'), $request->input('clientSecret'));

            return $this->successResponse($data);
        }
    }
}
