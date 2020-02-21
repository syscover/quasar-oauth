<?php namespace Quasar\OAuth\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Quasar\Core\Services\CoreService;
use Quasar\OAuth\Models\Application;

class ApplicationService extends CoreService
{
    public function create(array $data)
    {
        $this->validate($data, [
            'uuid'          => 'nullable|uuid',
            'code'          => 'required|string|unique:oauth_application,code',
            'secret'        => 'required',
            'name'          => 'required'
        ]);

        // set secret
        $data['secret'] = Hash::make($data['secret']);

        $object = Application::create($data)->fresh();

        return $object;
    }

    public function update(array $data, string $uuid)
    {
        $this->validate($data, [
            'id'            => 'required|integer',
            'uuid'          => 'required|uuid',
            'code'          => 'required|string|unique:oauth_application,code,' . $uuid . ',uuid',
            'secret'        => 'nullable',
            'name'          => 'required'
        ]);

        $object = Application::where('uuid', $uuid)->first();

        // check if there is secret
        if ($data['secret'] ?? false) $data['secret'] = Hash::make($data['secret']); else Arr::forget($data, 'secret');

        // fill data
        $object->fill($data);

        // save changes
        $object->save();

        return $object;
    }
}
