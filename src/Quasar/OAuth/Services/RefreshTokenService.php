<?php namespace Quasar\OAuth\Services;

use Illuminate\Support\Arr;
use Quasar\Core\Services\CoreService;
use Quasar\OAuth\Models\RefreshToken;

class RefreshTokenService extends CoreService
{
    public function create(array $data)
    {
        $this->validate($data, [
            'uuid'              => 'required|uuid',
            'accessTokenUuid'   => 'required|uuid',
            'token'             => 'required|string',
            'isRevoked'         => 'required|boolean',
            'expiresAt'         => 'nullable|uuid'
        ]);

        $object = RefreshToken::create($data)->fresh();

        return $object;
    }

    public function update(array $data, string $uuid)
    {
        // we make sure to delete variables that we don't want to update
        Arr::forget($data, 'accessTokenUuid');
        Arr::forget($data, 'token');

        $this->validate($data, [
            'isRevoked'         => 'required|boolean',
            'expiresAt'         => 'nullable|uuid'
        ]);

        $object = RefreshToken::where('uuid', $uuid)->first();

        // fill data
        $object->fill($data);

        // save changes
        $object->save();

        return $object;
    }
}
