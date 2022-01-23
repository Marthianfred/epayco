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


use LaravelDoctrine\ORM\Facades\EntityManager;

$router->get('/', function () use ($router) {
    //return $router->app->version();

    $repository = EntityManager::getRepository(\App\Entities\Clientes::class);
    dd($repository);
});


app()->router->get('soap/{key}/server', [
    'as' => 'zoap.server.wsdl',
    'uses' => '\Viewflex\Zoap\ZoapController@server'
]);

app()->router->post('soap/{key}/server', [
    'as' => 'zoap.server',
    'uses' => '\Viewflex\Zoap\ZoapController@server'
]);
