<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Stateful Domains
    |--------------------------------------------------------------------------
    |
    | Requests from the following domains / hosts will receive stateful API
    | authentication cookies. Typically, these should include your local
    | and production domains which access your API via a frontend SPA.
    |
    */

    'stateful' => explode(',', env(
        'SANCTUM_STATEFUL_DOMAINS',
        'localhost,localhost:3000,127.0.0.1,127.0.0.1:8000,::1'
    )),

    /*
    |--------------------------------------------------------------------------
    | Expiration Minutes
    |--------------------------------------------------------------------------
    |
    | This value controls the number of minutes until an issued token will be
    | considered expired. If this value is null, personal access tokens do
    | not expire. This won't tweak the lifetime of first-party sessions.
    |
    */

    'expiration' => null,

    /*
    |--------------------------------------------------------------------------
    | Sanctum Middleware
    |--------------------------------------------------------------------------
    |
    | When authenticating your first-party SPA with Sanctum you may need to
    | customize some of the middleware Sanctum uses while processing the
    | request. You may change the middleware listed below as required.
    |
    */

    'middleware' => [
        'verify_csrf_token' => App\Http\Middleware\VerifyCsrfToken::class,
        'encrypt_cookies' => App\Http\Middleware\EncryptCookies::class,
    ],

    'accept' => 'application/vnd.nuxcore.public.v1+json',

    'settings' => [
        'limit' => 500,
        'sort' => [
            'relevance' => ['id', 'desc'],
            'novelty' => ['created_at', 'asc'],
            '-novelty' => ['created_at', 'desc'],
            // For products
            'price' => ['price', 'asc'],
            '-price' => ['price', 'desc'],
            '-popularity' => ['rating', 'desc'],
        ],
        'search_mode' => [
            'REGULAR' => ['name'],
            'DESCRIPTIONS' => ['translation.name', 'translation.description']
        ]
    ],

    'errors' => [
        // 400 Bad request
        'parameter_not_available' => [
            'status' => 400,
            'message' => 'errors.api.message.parameter_not_available'
        ],

        // 403 Forbidden
        'access_error' => [
            'status' => 403,
            'message' => 'errors.api.message.access_error'
        ],

        // 404 Not Found
        'resource_item_not_found' => [
            'status' => 404,
            'message' => 'errors.api.message.resource_item_not_found'
        ],

        // Customs
        'cart' => [
            'product_not_found' => [
                'status' => 400,
                'message' => 'errors.api.message.cart.product_not_found'
            ],
        ],
    ]
];
