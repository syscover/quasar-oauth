<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class OAuthSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        $this->call(OAuthPackageSeeder::class);
        $this->call(OAuthApplicationSeeder::class);
        $this->call(OAuthClientSeeder::class);
        
        Model::reguard();
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="OAuthSeeder"
 */
