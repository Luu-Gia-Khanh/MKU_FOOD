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
        'client_id' => '172627974858695',
        'client_secret' => 'f38292a78dd62da8c6befe5e16ab60b8',
        'redirect' => 'https://mkufood.test/social_login/public/callback'
    ],
    'google' => [
        'client_id' => '339861231523-gg5flju7ncd78mmcd611h2ukjrn7hnii.apps.googleusercontent.com',
        'client_secret' => 'jYtwDVrWfzjDJZQWEwG-MUCj',
        'redirect' => 'http://localhost/MKU_FOOD/google/callback'
    ],

];
