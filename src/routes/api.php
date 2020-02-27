<?php

Route::group(['middleware' => ['api']], function () 
{
    // OAuth
    Route::post('oauth/credentials',                'Quasar\OAuth\Controllers\CredentialsController@credentials')->name('quasar.oauth.credentials');
    Route::get('oauth/authorize',                   'Quasar\OAuth\Controllers\CredentialsController@authorize')->name('quasar.oauth_credentials.authorize');
});