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
$router->group([], function () use ($router) {
  
});

$router->get('/fail', function () use ($router){
  return 'Not yet mature';
});
$router->group(['prefix' => 'api'], function () use ($router) {
  $router->post('/register', 'AuthController@register');
  $router->post('/login', 'AuthController@login');
  $router->get('/refresh_token', 'AuthController@refresh_token');
  $router->get('/check_login', 'AuthController@check_login');
  $router->get('/logout', 'AuthController@logout');

  $router->get('item',  ['uses' => 'ItemController@index']);
  $router->post('item', ['uses' => 'ItemController@store']);
  $router->get('item/{_id}', ['uses' => 'ItemController@show']);
  $router->put('item/{_id}', ['uses' => 'ItemController@update']);
  $router->delete('item/{_id}', ['uses' => 'ItemController@destroy']);
});