<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Post-auth Redirects
    |--------------------------------------------------------------------------
    |
    | Configure where users are redirected after successful login or
    | registration. This value can be set via the POST_LOGIN_REDIRECT env
    | variable. Default is the application root '/'.
    |
    */
    'home' => env('POST_LOGIN_REDIRECT', '/'),
];
