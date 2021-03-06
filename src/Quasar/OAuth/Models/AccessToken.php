<?php namespace Quasar\OAuth\Models;

use Quasar\Core\Models\CoreModel;

/**
 * Class AccessToken
 * @package Quasar\OAuth\Models
 */

class AccessToken extends CoreModel
{
    protected $table        = 'oauth_access_token';
    protected $fillable     = ['uuid', 'clientUuid', 'token', 'name', 'isRevoked', 'userType', 'userUuid', 'expiresAt'];
    public $with            = ['client', 'user'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_uuid', 'uuid');
    }

    public function user()
    {
        return $this->morphTo('user', 'user_type', 'user_uuid', 'uuid');
    }

    public function refreshTokens()
    {
        return $this->hasMany(RefreshToken::class, 'access_token_uuid', 'uuid');
    }
}
