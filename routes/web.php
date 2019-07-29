<?php
use Illuminate\Support\Facades\Storage;

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
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('posts','PostController@index');
    $router->get('posts/paginate','PostController@paginate');
    $router->get('posts/{id}','PostController@show');
    $router->put('posts/{id}','PostController@update');
});

$router->get('test',function (){
    return str_slug('asd asdasdasd SCźćżą');// rtrim(app()->basePath('public/'.'$path'), '/');
});

$router->get('/{route:.*}/', function ()  {
    return view('app');
});
