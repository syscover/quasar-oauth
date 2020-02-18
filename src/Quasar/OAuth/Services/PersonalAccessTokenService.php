<?php namespace Quasar\OAuth\Services;

use Illuminate\Support\Facades\Hash;

class PersonalAccessTokenService
{
    public static function validateUser(string $username, string $password, string $model)
    {
        $entity = $model::where('username', $username)->first();

        if ($entity && Hash::check($password, $entity->password)) return $entity;

        return null;
    }
}
