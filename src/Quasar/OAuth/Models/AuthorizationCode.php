<?php namespace Quasar\OAuth\Models;

use Quasar\Core\Models\CoreModel;

/**
 * Class AuthorizationCode
 * @package Quasar\OAuth\Models
 */

class AuthorizationCode extends CoreModel
{
    protected $table        = 'oauth_authorization_code';
    protected $fillable     = ['uuid', 'clientUuid', 'code', 'isRevoked', 'expiresAt'];
}
