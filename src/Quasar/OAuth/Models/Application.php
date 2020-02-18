<?php namespace Quasar\OAuth\Models;

use Quasar\Core\Models\CoreModel;

/**
 * Class Application
 * @package Quasar\OAuth\Models
 */

class Application extends CoreModel
{
    protected $table        = 'oauth_application';
    protected $fillable     = ['uuid', 'code', 'secret', 'name', 'model'];
    public $with            = ['clients'];

    public function clients()
    {
        return $this->hasMany(Client::class, 'application_uuid', 'uuid');
    }
}
