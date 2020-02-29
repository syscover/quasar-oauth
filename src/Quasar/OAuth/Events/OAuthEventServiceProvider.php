<?php namespace Quasar\OAuth\Events;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Quasar\OAuth\Events\LoginSuccessful;
use Quasar\OAuth\Listeners\LoginSuccessfulListener;

class OAuthEventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        LoginSuccessful::class => [
            LoginSuccessfulListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
