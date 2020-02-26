<?php

Route::group(['middleware' => ['api']], function () 
{
    // OAuth
    Route::post('oauth/credentials/token',          'Quasar\OAuth\Controllers\CredentialsController@token')->name('quasar.oauth_credentials.token');
    Route::post('oauth/credentials/refresh-token',  'Quasar\OAuth\Controllers\CredentialsController@refreshToken')->name('quasar.oauth_credentials.refresh_token');

    Route::get('oauth/authorize',                   'Quasar\OAuth\Controllers\CredentialsController@authorize')->name('quasar.oauth_credentials.authorize');
});