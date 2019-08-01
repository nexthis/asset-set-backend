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
$router->group(['prefix' => 'api'], function () use ($router) {

    $router->get('posts/paginate','PostController@paginate');
    
    $router->group(['middleware'=> 'jwt.auth'], function () use ($router){
        $router->get('posts','PostController@index');
        $router->post('posts','PostController@create');
        $router->delete('posts/{id}','PostController@delete');
        $router->get('posts/{id}','PostController@show');
        $router->put('posts/{id}','PostController@update');
    });

    

    $router->post('auth', 'AuthController@authenticate');
});

$router->get('test',function (){
    return URL::asset('s');// rtrim(app()->basePath('public/'.'$path'), '/');
});

$router->get('/{route:.*}/', function ()  {
    return view('app');
});
