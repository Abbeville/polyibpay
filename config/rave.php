<?php

/*
 * This file is part of the Laravel Rave package.
 *
 * (c) Oluwole Adebiyi - Flamez <flamekeed@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /**
     * Public Key: Your Rave publicKey. Sign up on https://rave.flutterwave.com/ to get one from your settings page
     *
     */
    // 'publicKey' => env('RAVE_PUBLIC_KEY', 'FLWPUBK_TEST-e091d2070e761ca054e1e6fbaa586f27-X'),
    'publicKey' => 'FLWPUBK_TEST-e091d2070e761ca054e1e6fbaa586f27-X',

    /**
     * Secret Key: Your Rave secretKey. Sign up on https://rave.flutterwave.com/ to get one from your settings page
     *
     */
    // 'secretKey' => env('RAVE_SECRET_KEY', 'FLWSECK_TEST-3271edff45fdeff49120a73b08dbdc3f-MX'),
    'secretKey' => 'FLWSECK_TEST-3271edff45fdeff49120a73b08dbdc3f-X',

    /**
     * Company/Business/Store Name: The name of your store
     *
     */
    'title' => env('RAVE_TITLE', 'Rave Payment Gateway'),

    /**
     * Environment: This can either be 'staging' or 'live'
     *
     */
    'env' => env('RAVE_ENVIRONMENT', 'staging'),

    /**
     * Logo: Enter the URL of your company/business logo
     *
     */
    'logo' => env('RAVE_LOGO', ''),

    /**
     * Prefix: This is added to the front of your transaction reference numbers
     *
     */
    'prefix' => env('RAVE_PREFIX', 'W'),

    /**
     * Prefix: This is added to the front of your transaction reference numbers
     *
     */
    // 'secretHash' => env('RAVE_SECRET_HASH', 'FLWSECK_TESTfe4a1ac00578'),
    'secretHash' => 'FLWSECK_TESTfe4a1ac00578',
];
