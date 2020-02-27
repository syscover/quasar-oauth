<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Quasar\OAuth\Services\ClientService;

class OAuthClientSeeder extends Seeder
{
    public function run(ClientService $service)
    {
        $service->create(
            [
                'uuid'                  => '333910d9-394b-42d7-b3e0-0c7ae7a54478', 
                'applicationUuid'       => '8bb03dc8-c97b-4e06-b1b0-3c62e108fd80',
                'grantTypeUuid'         => 'a48e6aa0-2e9a-492d-b63b-d5b6223e74e2', 
                'name'                  => 'Password Grant', 
                'secret'                => Str::random(40),
                'model'                 => 'Quasar\Admin\Models\User',
                'redirect'              => null,
                'expiredAccessToken'    => 3600,
                'expiredRefreshToken'   => 7200,
                'isRevoked'             => false, 
                'isMaster'              => true
            ]
        );
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="OAuthClientSeeder"
 */
