<?php

Route::group(['middleware' => ['api']], function () 
{
    // OAuth
    Route::post('oauth/credentials',                'Quasar\OAuth\Controllers\CredentialsController@credentials')->name('quasar.oauth.credentials');
    Route::get('oauth/authorize',                   'Quasar\OAuth\Controllers\CredentialsController@authorize')->name('quasar.oauth-credentials.authorize');

    // Rest Hook
    Route::get('oauth/rest-hook',                   'Quasar\OAuth\Controllers\RestHookController@get')->name('quasar.oauth.rest-hook.get');
    Route::get('oauth/rest-hook/find',              'Quasar\OAuth\Controllers\RestHookController@find')->name('quasar.oauth.rest-hook.find');
    Route::post('oauth/rest-hook',                  'Quasar\OAuth\Controllers\RestHookController@create')->name('quasar.oauth.rest-hook.create');
    Route::put('oauth/rest-hook',                   'Quasar\OAuth\Controllers\RestHookController@update')->name('quasar.oauth.rest-hook.update');
    Route::delete('oauth/rest-hook',                'Quasar\OAuth\Controllers\RestHookController@delete')->name('quasar.oauth.rest-hook.delete');
});