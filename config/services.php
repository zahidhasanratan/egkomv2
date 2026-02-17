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

    'shurjopay' => [
        'username' => env('SP_USERNAME', env('MERCHANT_USERNAME')),
        'password' => env('SP_PASSWORD', env('MERCHANT_PASSWORD')),
        'prefix' => env('SP_PREFIX', env('MERCHANT_PREFIX', 'SIC')),
        'api' => env('SHURJOPAY_API', 'https://sandbox.shurjopayment.com'),
        'callback' => env('SP_CALLBACK'),
        'log_path' => env('SP_LOG_LOCATION', storage_path('logs')),
    ],

];
