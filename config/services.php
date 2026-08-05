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

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'leads' => [
        'notification_email' => env('LEAD_NOTIFICATION_EMAIL'),
        'from_name' => env('LEAD_NOTIFICATION_FROM_NAME', "Moore's Farm Equipment"),
    ],

    'meta' => [
        'pixel_id' => env('META_PIXEL_ID'),
        'pixel_enabled' => filter_var(env('META_PIXEL_ENABLED', false), FILTER_VALIDATE_BOOLEAN),

        'capi_enabled' => filter_var(env('META_CAPI_ENABLED', false), FILTER_VALIDATE_BOOLEAN),
        'capi_access_token' => env('META_CAPI_ACCESS_TOKEN'),
        'capi_test_event_code' => env('META_CAPI_TEST_EVENT_CODE'),
        'capi_debug' => filter_var(env('META_CAPI_DEBUG', false), FILTER_VALIDATE_BOOLEAN),
        'graph_api_version' => env('META_GRAPH_API_VERSION', 'v25.0'),
    ],

];
