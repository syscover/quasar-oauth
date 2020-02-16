<?php namespace Quasar\OAuth\Models;

use Quasar\Core\Models\CoreModel;

/**
 * Class Client
 * @package Quasar\OAuth\Models
 */

class Client extends CoreModel
{
    protected $table        = 'oauth_client';
    protected $fillable     = ['uuid', 'type_uuid', 'name', 'secret', 'redirect', 'is_revoked'];
}
