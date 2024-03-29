<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'facebook' => [
        'client_id' => '867557233900891',
        'client_secret' => '5827fcf96f62107612931b951daa5589',
        'redirect' => 'http://localhost/MKU_FOOD/callback'
    ],
    'google' => [
        'client_id' => '339861231523-gg5flju7ncd78mmcd611h2ukjrn7hnii.apps.googleusercontent.com',
        'client_secret' => 'jYtwDVrWfzjDJZQWEwG-MUCj',
        'redirect' => 'http://mkufood.abc/google/callback'
    ],

];
