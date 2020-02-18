<?php

use Illuminate\Database\Seeder;
use Quasar\Admin\Services\PackageService;

class OAuthPackageSeeder extends Seeder
{
    public function run(PackageService $service)
    {
        $service->create(
            [
                'id'        => 3, 
                'uuid'      => '786320e6-0e9e-41f8-b158-94a06b6494b2', 
                'name'      => 'OAuth', 
                'root'      => 'oauth', 
                'sort'      => 3, 
                'isActive'  => 1
            ]
        );
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="OAuthPackageSeeder"
 */
