<?php

use Illuminate\Database\Seeder;
use Quasar\Admin\Models\Permission;

class OAuthPermissionSeeder extends Seeder
{
    public function run()
    {
        Permission::insert([
            // oauth
            ['uuid' => 'aae537d9-5b1e-4b0e-a84a-f21a77f1006f',  'name' => 'admin.oauth.access',                               'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'],
            ['uuid' => 'be37f67c-b688-4e81-b99f-241284892dad',  'name' => 'admin.oauth.accessToken.access',                   'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'],
            ['uuid' => '4a96cbe0-2d6b-4462-ab9e-6d81f566cb40',  'name' => 'admin.oauth.accessToken.list',                     'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'],
            ['uuid' => '2c53dc61-8b42-40bf-ac55-23bd6d6de8ec',  'name' => 'admin.oauth.accessToken.create',                   'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'],
            ['uuid' => '082f3f75-fab2-4a87-b335-d71b6ea619f1',  'name' => 'admin.oauth.accessToken.get',                      'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'], 
            ['uuid' => '58ea9e88-4aa9-4c16-b2e2-10d48ce2ee07',  'name' => 'admin.oauth.application.access',                   'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'],
            ['uuid' => 'ef1ed81f-16fc-4ea3-ab84-e1fa8fcb7d40',  'name' => 'admin.oauth.application.list',                     'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'],
            ['uuid' => '9244b819-4ebc-4ca4-baeb-8b8d23748cc2',  'name' => 'admin.oauth.application.create',                   'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'],
            ['uuid' => 'eb571e06-2e6f-4299-93e5-428c94778bac',  'name' => 'admin.oauth.application.get',                      'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'], 
            ['uuid' => '058655a2-f391-4da2-a996-176f367baa87',  'name' => 'admin.oauth.client.access',                        'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'],
            ['uuid' => 'ebbc1af8-9a14-4a16-b758-a8e551069c0b',  'name' => 'admin.oauth.client.list',                          'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'],
            ['uuid' => '55576c5c-2db5-48af-ab29-5c7a3320b64a',  'name' => 'admin.oauth.client.create',                        'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'],
            ['uuid' => '94a80909-44b1-484e-ba55-6f8be97833e8',  'name' => 'admin.oauth.client.get',                           'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'], 
            ['uuid' => 'c59b57f4-23c4-4124-a80d-a2b914412494',  'name' => 'admin.oauth.refreshToken.access',                  'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'],
            ['uuid' => 'dffd734f-b711-45c3-abc5-b432c372de6a',  'name' => 'admin.oauth.refreshToken.list',                    'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'],
            ['uuid' => 'dc832da1-72e7-4bf4-b5b2-35698f3ebfa5',  'name' => 'admin.oauth.refreshToken.create',                  'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'],
            ['uuid' => 'c9797746-7b3d-4197-b78f-0d070e338a50',  'name' => 'admin.oauth.refreshToken.get',                     'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'], 
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="OAuthPermissionSeeder"
 */
