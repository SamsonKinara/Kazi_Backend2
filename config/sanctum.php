<?php

use Laravel\Sanctum\Sanctum;

return [

    /*
    |--------------------------------------------------------------------------
    | Stateful Domains
    |--------------------------------------------------------------------------
    |
    | Requests from the following domains / hosts will receive stateful API
    | authentication cookies. These are typically used for front-end SPAs.
    | For token-based authentication, you don't need stateful domains.
    |
    */

    'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', sprintf(
        '%s%s',
        'localhost,localhost:3000,127.0.0.1,127.0.0.1:8000,::1',
        Sanctum::currentApplicationUrlWithPort()
    ))),

    /*
    |--------------------------------------------------------------------------
    | Sanctum Guards
    |--------------------------------------------------------------------------
    |
    | This array contains the authentication guards that will be checked when
    | Sanctum is trying to authenticate a request. For stateless token-based
    | authentication, ensure your API guard is set to 'api'.
    |
    */

    'guard' => ['api'], // Ensure you're using the 'api' guard for token-based authentication

    /*
    |--------------------------------------------------------------------------
    | Expiration Minutes
    |--------------------------------------------------------------------------
    |
    | This value controls the number of minutes until an issued token will be
    | considered expired. Setting this to null means tokens will not expire.
    |
    */

    'expiration' => null,  // Tokens do not expire unless manually revoked

    /*
    |--------------------------------------------------------------------------
    | Token Prefix
    |--------------------------------------------------------------------------
    |
    | Sanctum can prefix new tokens in order to add security by helping
    | prevent accidental exposure in repositories or elsewhere.
    |
    */

    'token_prefix' => env('SANCTUM_TOKEN_PREFIX', ''),

    /*
    |--------------------------------------------------------------------------
    | Sanctum Middleware
    |--------------------------------------------------------------------------
    |
    | Since you are using stateless authentication, we don't need the middleware
    | related to session management or cookies. You can safely remove the 
    | `encrypt_cookies` and `validate_csrf_token` middleware here.
    |
    */

    'middleware' => [
        // No session-related middleware, using stateless authentication
        'authenticate_session' => Laravel\Sanctum\Http\Middleware\AuthenticateSession::class, // Optional if you plan to have stateful requests in the future
    ],

];
