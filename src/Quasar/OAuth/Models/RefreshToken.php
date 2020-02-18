<?php namespace Quasar\OAuth\Models;

use Quasar\Core\Models\CoreModel;

/**
 * Class RefreshToken
 * @package Quasar\OAuth\Models
 */

class RefreshToken extends CoreModel
{
    protected $table        = 'oauth_refresh_token';
    protected $fillable     = ['uuid', 'accessTokenUuid', 'token', 'isRevoked', 'expiresAt'];
    public $with            = ['accessToken'];

    public function accessToken()
    {
        return $this->belongsTo(AccessToken::class, 'access_token_uuid', 'uuid');
    }
}
