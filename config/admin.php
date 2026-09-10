<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin Prefix
    |--------------------------------------------------------------------------
    |
    | This value is the URL prefix for all admin routes.
    |
    */

    'admin_prefix' => env('ADMIN_PREFIX'),

    /*
    |--------------------------------------------------------------------------
    | Admin Session Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for admin session storage.
    |
    */

    'session' => [
        'table' => 'admin_sessions',
        'lifetime' => 120,
        'expire_on_close' => false,
    ],

];
