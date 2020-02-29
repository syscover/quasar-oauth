<?php namespace Quasar\OAuth\Models;

use Quasar\Core\Models\CoreModel;

/**
 * Class RestHook
 * @package Quasar\OAuth\Models
 */

class RestHook extends CoreModel
{
    protected $table        = 'oauth_rest_hook';
    protected $fillable     = ['uuid', 'clientUuid', 'url', 'event'];
    public $with            = ['client'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_uuid', 'uuid');
    }
}
