<?php

use Illuminate\Database\Seeder;
use Quasar\Admin\Models\Permission;

class OAuthPermissionSeeder extends Seeder
{
    public function run()
    {
        Permission::insert([
            // oauth
            ['uuid' => 'fc601f87-8b04-4e07-8d11-8213b272ddf0',  'name' => 'admin.oauth.access',                               'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'],
            ['uuid' => '3dae3151-61b2-48a9-b2f0-84736249dfba',  'name' => 'admin.oauth.accessToken.access',                   'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'],
            ['uuid' => '824a4c32-b520-4c52-8867-ad7e79bd972a',  'name' => 'admin.oauth.accessToken.list',                     'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'],
            ['uuid' => 'd96c421d-f24b-464f-ad31-dc3fe77e7814',  'name' => 'admin.oauth.accessToken.create',                   'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'],
            ['uuid' => 'dfe2eab2-d554-4d05-9a31-d1e8ebaad65f',  'name' => 'admin.oauth.accessToken.get',                      'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'], 
            ['uuid' => '87990577-6ac7-405e-b0ab-bba6b0e7010b',  'name' => 'admin.oauth.application.access',                   'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'],
            ['uuid' => 'd244dc82-b6e5-4223-811a-bdd946805c22',  'name' => 'admin.oauth.application.list',                     'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'],
            ['uuid' => 'fc3a4ade-6900-4eca-8d28-1bc515b3970f',  'name' => 'admin.oauth.application.create',                   'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'],
            ['uuid' => 'e5fb9004-db6c-4234-afd7-32205bb57a43',  'name' => 'admin.oauth.application.get',                      'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'], 
            ['uuid' => '874f6393-6dd9-4d83-86e8-3999667dd358',  'name' => 'admin.oauth.client.access',                        'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'],
            ['uuid' => '824a4c32-b520-4c52-8867-ad7e79bd972a',  'name' => 'admin.oauth.client.list',                          'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'],
            ['uuid' => 'd96c421d-f24b-464f-ad31-dc3fe77e7814',  'name' => 'admin.oauth.client.create',                        'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'],
            ['uuid' => 'dfe2eab2-d554-4d05-9a31-d1e8ebaad65f',  'name' => 'admin.oauth.client.get',                           'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'], 
            ['uuid' => '93816bef-5aaa-402c-a4d0-f0efb112ebcd',  'name' => 'admin.oauth.refreshToken.access',                  'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'],
            ['uuid' => 'dffaf7c8-2523-49a0-a5f0-325148492d6c',  'name' => 'admin.oauth.refreshToken.list',                    'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'],
            ['uuid' => '00dd56cf-2e75-4bf0-b91b-f5d0ec8a4cdc',  'name' => 'admin.oauth.refreshToken.create',                  'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'],
            ['uuid' => '69721286-9362-4536-95c5-ddca6965824f',  'name' => 'admin.oauth.refreshToken.get',                     'package_uuid' => '786320e6-0e9e-41f8-b158-94a06b6494b2'], 
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="OAuthPermissionSeeder"
 */
