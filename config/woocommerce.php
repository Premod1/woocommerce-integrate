<?php

return [
    /*
    |--------------------------------------------------------------------------
    | WooCommerce Store URL
    |--------------------------------------------------------------------------
    |
    | This is the base URL of your WooCommerce store.
    |
    */
    'store_url' => env('WOOCOMMERCE_STORE_URL', 'https://example.com'),

    /*
    |--------------------------------------------------------------------------
    | WooCommerce Consumer Key
    |--------------------------------------------------------------------------
    |
    | The consumer key generated from WooCommerce Settings > Advanced > REST API.
    |
    */
    'consumer_key' => env('WOOCOMMERCE_CONSUMER_KEY'),

    /*
    |--------------------------------------------------------------------------
    | WooCommerce Consumer Secret
    |--------------------------------------------------------------------------
    |
    | The consumer secret generated from WooCommerce Settings > Advanced > REST API.
    |
    */
    'consumer_secret' => env('WOOCOMMERCE_CONSUMER_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | Verify SSL
    |--------------------------------------------------------------------------
    |
    | Whether to verify the SSL certificate of the WooCommerce store.
    |
    */
    'verify_ssl' => env('WOOCOMMERCE_VERIFY_SSL', true),

    /*
    |--------------------------------------------------------------------------
    | API Version
    |--------------------------------------------------------------------------
    |
    | The version of the WooCommerce REST API to use.
    |
    */
    'api_version' => env('WOOCOMMERCE_API_VERSION', 'wc/v3'),
];
