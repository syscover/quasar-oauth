<?php namespace Quasar\OAuth\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Quasar\Core\Services\CoreService;
use Quasar\OAuth\Models\Client;

class ClientService extends CoreService
{
    public function create(array $data)
    {
        $this->validate($data, [
            'uuid'                  => 'nullable|uuid',
            'applicationUuid'       => 'required|uuid',
            'grantTypeUuid'         => 'required|uuid',
            'name'                  => 'required|string',
            'model'                 => 'nullable|string',
            'redirect'              => 'required|string',
            'expiredAccessToken'    => 'nullable|integer',
            'expiredRefreshToken'   => 'nullable|integer',
            'isRevoked'             => 'required|boolean',
            'isMaster'              => 'boolean'
        ]);

        // set secret
        $data['secret'] = Str::random(40);

        $object = Client::create($data)->fresh();

        return $object;
    }

    public function update(array $data, string $uuid)
    {
        // we make sure to delete variables that we don't want to update
        Arr::forget($data, 'secret');
        Arr::forget($data, 'isMaster');

        $this->validate($data, [
            'id'                    => 'required|integer',
            'uuid'                  => 'required|uuid',
            'applicationUuid'       => 'required|uuid',
            'grantTypeUuid'         => 'required|uuid',
            'name'                  => 'required|string',
            'model'                 => 'nullable|string',
            'redirect'              => 'required|string',
            'expiredAccessToken'    => 'nullable|integer',
            'expiredRefreshToken'   => 'nullable|integer',
            'isRevoked'             => 'required|boolean'
        ]);

        $object = Client::where('uuid', $uuid)->first();

        // fill data
        $object->fill($data);

        // save changes
        $object->save();

        return $object;
    }
}
