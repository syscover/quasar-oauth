<?php namespace Quasar\OAuth\Models;

use Quasar\Core\Models\CoreModel;

/**
 * Class Client
 * @package Quasar\OAuth\Models
 */

class Client extends CoreModel
{
    protected $table        = 'oauth_client';
    protected $fillable     = ['uuid', 'applicationUuid', 'grantTypeUuid', 'name', 'secret', 'model', 'redirect', 'expiredAccessToken', 'expiredRefreshToken', 'isRevoked', 'isMaster'];
    protected $hidden       = ['secret'];
    public $with            = ['authorizationCodes'];

    public function application()
    {
        return $this->belongsTo(Application::class, 'application_uuid', 'uuid');
    }

    public function authorizationCodes()
    {
        return $this->hasMany(AuthorizationCode::class, 'client_uuid', 'uuid');
    }
}
