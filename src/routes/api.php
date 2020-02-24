<?php

Route::group(['middleware' => ['api']], function () 
{
    // OAuth
    Route::post('oauth/credentials/token', 'Quasar\OAuth\Controllers\CredentialsController@getToken')->name('quasar.oauth_credentials.token');
});