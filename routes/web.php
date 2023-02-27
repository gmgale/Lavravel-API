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

/*
| Post routes
*/
$router->group([], function () use ($router) {


    $router->get('post', function (){
        return 'All posts';
    });

    $router->get('post/{id}', function ($id) {
        return $id;
    });
});

