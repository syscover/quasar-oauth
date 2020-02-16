<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Quasar\OAuth\Models\Client;

class OAuthClientSeeder extends Seeder
{
    public function run()
    {
        Client::insert([
            ['uuid' => '333910d9-394b-42d7-b3e0-0c7ae7a54478', 'type_uuid' => '974a4a29-92b3-47c3-a282-f2b9058aa273', 'name' => 'Personal Access Token', 'secret' => Str::random(40), 'redirect' => config('app.url'), 'is_revoked' => false]
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="OAuthClientSeeder"
 */
