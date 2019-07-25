<?php

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
$router->group(['middleware' => 'subdomain:api'], function () use ($router) {
    $router->get('posts','PostController@index');
    $router->get('posts/paginate','PostController@paginate');
});

$router->get('/{route:.*}/', function ()  {
    return view('app');
});
