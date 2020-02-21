<?php

use Illuminate\Database\Seeder;
use Quasar\OAuth\Services\ApplicationService;

class OAuthApplicationSeeder extends Seeder
{
    public function run(ApplicationService $service)
    {
        $service->create(
            [
                'id'        => 1, 
                'uuid'      => '8bb03dc8-c97b-4e06-b1b0-3c62e108fd80', 
                'code'      => 'admin.user', 
                'secret'    => '4$rAt@p2Y3$3', 
                'name'      => 'Admin - User'
            ]
        );
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="OAuthApplicationSeeder"
 */
