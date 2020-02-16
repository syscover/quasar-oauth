<?php

return [

    //******************************************************************************************************************
    //***   Expiration time of personal access token
    //******************************************************************************************************************
    'personal_access_token_expiration' => env('OAUTH_PERSONAL_ACCESS_TOKEN_EXPIRATION', 3000),

    //******************************************************************************************************************
    //***   Expiration time of personal refresh token
    //******************************************************************************************************************
    'personal_refresh_token_expiration' => env('OAUTH_PERSONAL_REFRESH_TOKEN_EXPIRATION', 6000),

    //******************************************************************************************************************
    //***   Types of auth clients
    //******************************************************************************************************************
    'client_types' => [
        (object)['uuid' => '974a4a29-92b3-47c3-a282-f2b9058aa273', 'id' => 1, 'name' => 'Personal Access Token'],
        (object)['uuid' => 'a48e6aa0-2e9a-492d-b63b-d5b6223e74e2', 'id' => 2, 'name' => 'Password Grant Tokens'],
        (object)['uuid' => 'bea89c67-032e-462d-8ddd-70cbfd427f7a', 'id' => 3, 'name' => 'Client Credentials Grant Tokens'],
    ],
];