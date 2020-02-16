<?php namespace Quasar\OAuth\Models;

use Quasar\Core\Models\CoreModel;

/**
 * Class RefreshToken
 * @package Quasar\OAuth\Models
 */

class RefreshToken extends CoreModel
{
    protected $table        = 'oauth_refresh_token';
    protected $fillable     = ['uuid', 'access_token_uuid', 'token', 'is_revoked', 'expires_at'];
}
