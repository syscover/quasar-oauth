<?php namespace Quasar\OAuth\Services;

use Illuminate\Support\Str;
use Quasar\OAuth\Models\AuthorizationCode;

class AuthorizationCodeService
{
    public function create(array $data)
    {
        $this->validate($data, [
            'uuid'          => 'nullable|uuid',
            'clientUuid'    => 'required|uuid|exists:oauth_client,uuid',
            'isRevoked'     => 'required|boolean',
            'expiresAt'     => 'nullable|date_format:Y-m-d H:i:s'
        ]);

        // set code
        $data['code'] = Str::uuid();

        $object = AuthorizationCode::create($data)->fresh();

        // clean older codes
        self::clean();

        return $object;
    }

    public function update(array $data, string $uuid)
    {
        $this->validate($data, [
            'id'            => 'required|integer',
            'uuid'          => 'required|uuid',
            'clientUuid'    => 'required|uuid|exists:oauth_client,uuid',
            'code'          => 'required|uuid',
            'isRevoked'     => 'required|boolean',
            'expiresAt'     => 'nullable|date_format:Y-m-d H:i:s'
        ]);

        $object = AuthorizationCode::where('uuid', $uuid)->first();

        // fill data
        $object->fill($data);

        // save changes
        $object->save();

        return $object;
    }

    public static function getCode(string $clientUuid)
    {
        $authorizationCode = self::create([
            'clientUuid'    => $clientUuid,
            'expiresAt'     => now()->addMinutes(5) // all authorization codes has 5 minutes expiration
        ]);

        return $authorizationCode->code;
    }

    /**
     * Delete all authorization code with a month expired
     */
    private static function clean()
    {
        AuthorizationCode::where('expires_at', '<', now()->subMonth())->delete();
    }
}
