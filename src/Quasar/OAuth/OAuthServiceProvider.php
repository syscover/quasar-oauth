<?php namespace Quasar\OAuth;

use Illuminate\Support\ServiceProvider;

class OAuthServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
        // register routes
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');
        
        // register migrations
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        // register views
		$this->loadViewsFrom(__DIR__ . '/../../resources/views', 'oauth');

        // register seeds
        $this->publishes([
            __DIR__ . '/../../database/seeds/' => base_path('/database/seeds')
        ], 'seeds');

        // register config
        $this->publishes([
            __DIR__ . '/../../config/quasar-oauth.php' => config_path('quasar-oauth.php')
        ], 'config');
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
        //
	}
}
