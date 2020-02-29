<?php namespace Quasar\OAuth\Services;

use Quasar\Core\Services\CoreService;
use Quasar\OAuth\Models\RestHook;

class RestHookService extends CoreService
{
    public function create(array $data)
    {
        $this->validate($data, [
            'uuid'          => 'nullable|uuid',
            'clientUuid'    => 'nullable|uuid|exists:oauth_client,uuid',
            'url'           => 'required|string',
            'event'         => 'required|string'
        ]);

        $object = RestHook::create($data)->fresh();

        return $object;
    }

    public function update(array $data, string $uuid)
    {
        $this->validate($data, [
            'id'            => 'required|integer',
            'uuid'          => 'required|uuid',
            'clientUuid'    => 'nullable|uuid|exists:oauth_client,uuid',
            'url'           => 'required|string',
            'event'         => 'required|string'
        ]);

        $object = RestHook::where('uuid', $uuid)->first();

        // fill data
        $object->fill($data);

        // save changes
        $object->save();

        return $object;
    }
}
