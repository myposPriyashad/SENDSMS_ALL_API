<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/key', function() {
    return \Illuminate\Support\Str::random(32);
});

$router->group(['prefix' => 'dialog'], function () use ($router) {
        $router->get('',['uses'=>'DialogToken@GenerateToken']);
});

$router->group(['prefix' => 'dialogtokenSMS'], function () use ($router) {
    $router->get('',['uses'=>'DialogToken@SendSMS']);
});

$router->group(['prefix' => 'dialogcpSMS'], function () use ($router) {
    $router->get('',['uses'=>'DialogCP@SendSMS']);
});

$router->group(['prefix' => 'etisalatSMS'], function () use ($router) {
    $router->get('',['uses'=>'Etisalat@SendSMS']);
});
