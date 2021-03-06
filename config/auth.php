<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'member',
        'passwords' => 'member',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | user are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session", "token"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'user',
        ],
        'manage' => [
            'driver' => 'session',
            'provider' => 'manage',
        ],

        'enterprise' => [
            'driver' => 'session',
            'provider' => 'enterprise',
        ],
        'member' => [
            'driver' => 'session',
            'provider' => 'member',
        ],

        'api' => [
            'driver' => 'passport',
            'provider' => 'member',
        ],
//
//        'api' => [
//            'driver' => 'token',
//            'provider' => 'user',
//        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | user are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'user' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'manage' => [
            'driver' => 'eloquent',
            'model' => App\Models\Manage_User::class,
        ],
        'enterprise' => [
            'driver' => 'eloquent',
            'model' => App\Models\Enterprise::class,
        ],
        'member' => [
            'driver' => 'eloquent',
            'model' => App\Models\Member_User::class,
        ],
        // 'user' => [
        //     'driver' => 'database',
        //     'table' => 'user',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expire time is the number of minutes that the reset token should be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    */

    'passwords' => [
        'user' => [
            'provider' => 'user',
            'table' => 'user_reset',
            'expire' => 60,
        ],
        'manage' => [
            'provider' => 'manage',
            'table' => 'manage_user_reset',
            'expire' => 60,
        ],
        'member' => [
            'provider' => 'member',
            'table' => 'member_user_reset',
            'expire' => 60,
        ],
    ],

];
