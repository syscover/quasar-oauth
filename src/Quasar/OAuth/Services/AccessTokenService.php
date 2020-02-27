<?php namespace Quasar\OAuth\Services;

use Illuminate\Support\Arr;
use Quasar\Core\Services\CoreService;
use Quasar\OAuth\Models\AccessToken;

class AccessTokenService extends CoreService
{
    public function create(array $data)
    {
        $this->validate($data, [
            'uuid'          => 'required|uuid',
            'clientUuid'    => 'required|uuid|exists:oauth_client,uuid',
            'token'         => 'required|string',
            'isRevoked'     => 'required|boolean',
            'name'          => 'required',
            'userUuid'      => 'nullable|uuid',
            'userType'      => 'nullable',
            'expiresAt'     => 'nullable|date_format:Y-m-d H:i:s'
        ]);

        $object = AccessToken::create($data)->fresh();

        return $object;
    }

    public function update(array $data, string $uuid)
    {
        // we make sure to delete variables that we don't want to update
        Arr::forget($data, 'clientUuid');
        Arr::forget($data, 'token');
        Arr::forget($data, 'userUuid');
        Arr::forget($data, 'userType');

        $this->validate($data, [
            'id'            => 'required|integer',
            'uuid'          => 'required|uuid',
            'isRevoked'     => 'required|boolean',
            'name'          => 'required',
            'expiresAt'     => 'nullable|date_format:Y-m-d H:i:s'
        ]);

        $object = AccessToken::where('uuid', $uuid)->first();

        // fill data
        $object->fill($data);

        // save changes
        $object->save();

        return $object;
    }

    public static function getAccessTokenObject(string $bearerToken)
    {
        $accessTokenArr = (array) JWTService::decode($bearerToken);
        $accessTokenObj = AccessToken::where('uuid', $accessTokenArr['jit'])->first();

        // check token and client
        if (!$accessTokenObj->isRevoke && !$accessTokenObj->client->isRevoke)
        {
            JWTService::decode($bearerToken, $accessTokenObj->client->secret);
        }

        return $accessTokenObj;
    }
}
