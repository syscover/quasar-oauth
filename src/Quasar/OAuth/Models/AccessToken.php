<?php namespace Quasar\OAuth\Models;

use Quasar\Core\Models\CoreModel;

/**
 * Class AccessToken
 * @package Quasar\OAuth\Models
 */

class AccessToken extends CoreModel
{
    protected $table        = 'oauth_access_token';
    protected $fillable     = ['uuid', 'token', 'name', 'is_revoked', 'user_uuid', 'user_type', 'expires_at'];
}
