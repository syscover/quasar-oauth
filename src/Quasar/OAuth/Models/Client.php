<?php namespace Quasar\OAuth\Models;

use Quasar\Core\Models\CoreModel;

/**
 * Class Client
 * @package Quasar\OAuth\Models
 */

class Client extends CoreModel
{
    protected $table        = 'oauth_client';
    protected $fillable     = ['uuid', 'applicationUuid', 'typeUuid', 'name', 'secret', 'model', 'redirect', 'isRevoked', 'isMaster'];
    protected $hidden       = ['secret'];
}
