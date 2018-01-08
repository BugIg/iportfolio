<?php

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api = app(Router::class);

$api->version('v1', function (Router $api) {
    $api->group(['prefix' => 'auth', 'namespace' => 'App\\Api\\V1\\Controllers\\Auth'], function(Router $api) {
        $api->post('signup', 'SignUpController@signUp');
        $api->post('login', 'LoginController@login');

        $api->post('recovery', 'ForgotPasswordController@sendResetEmail');
        $api->post('reset', 'ResetPasswordController@resetPassword');

        $api->post('logout', 'LogoutController@logout');
        $api->post('refresh', 'RefreshController@refresh');

    });

    $api->group(['middleware' => ['jwt.auth','role:admin'], 'prefix' => 'admin', 'namespace' => 'App\\Api\\V1\\Admin\\Controllers'], function(Router $api) {
        //$api->get('dashboard', 'DashboardController@index');
        $api->resource('users', 'UserController');
        $api->resource('markets', 'MarketController');
        $api->resource('coins', 'CoinController');
    });

    $api->group(['middleware' => 'jwt.auth', 'namespace' => 'App\\Api\\V1\\Controllers'], function(Router $api) {
        $api->get('me', 'UserController@me');

        $api->get('protected', function() {
            return response()->json([
                'message' => 'Access to protected resources granted! You are seeing this text as you provided the token correctly.'
            ]);
        });

        $api->get('refresh', [
            'middleware' => 'jwt.refresh',
            function() {
                return response()->json([
                    'message' => 'By accessing this endpoint, you can refresh your access token at each request. Check out this response headers!'
                ]);
            }
        ]);
    });

    $api->get('hello', function() {
        return response()->json([
            'message' => 'This is a simple example of item returned by your APIs. Everyone can see it.'
        ]);
    });
});
