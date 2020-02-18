<?php namespace Quasar\OAuth\Services;

use Illuminate\Support\Arr;
use Quasar\Core\Services\CoreService;
use Quasar\OAuth\Models\Client;

class ClientService extends CoreService
{
    public function create(array $data)
    {
        $this->validate($data, [
            'uuid'              => 'nullable|uuid',
            'applicationUuid'   => 'required|uuid',
            'typeUuid'          => 'required|uuid',
            'name'              => 'required|string',
            'secret'            => 'required|string',
            'redirect'          => 'required|string',
            'isRevoked'         => 'required|boolean',
            'isMaster'          => 'required|boolean'
        ]);

        $object = Client::create($data)->fresh();

        return $object;
    }

    public function update(array $data, string $uuid)
    {
        // we make sure to delete variables that we don't want to update
        Arr::forget($data, 'secret');

        $this->validate($data, [
            'id'                => 'required|integer',
            'uuid'              => 'required|uuid',
            'applicationUuid'   => 'required|uuid',
            'typeUuid'          => 'required|uuid',
            'name'              => 'required|string',
            'redirect'          => 'required|string',
            'isRevoked'         => 'required|boolean',
            'isMaster'          => 'required|boolean'
        ]);

        $object = Client::where('uuid', $uuid)->first();

        // fill data
        $object->fill($data);

        // save changes
        $object->save();

        return $object;
    }
}
