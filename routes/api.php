<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use Dingo\Api\Routing\Router;
use Illuminate\Http\Request;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

$router = app(Router::class);

$routeConfigV1 = [
    'namespace' => 'ErpNET\Models\v1\Controllers',
//            'prefix' => $this->app['config']->get('debugbar.route_prefix'),
];

$router
    ->version('v1', function (Router $router) use ($routeConfigV1) {
        $router
            ->group($routeConfigV1, function (Router $router) {
                $router->get('appVersion', [
                    'as'=>'api.appVersion',
                    'uses'=> 'ApiController@appVersion'
                ]);

                $router->resource('mandante', 'MandanteController');
                $router->resource('order', 'OrderController');
                $router->resource('partner', 'PartnerController');
                $router->resource('post', 'PostController');

                $router->get('/post/{post}/random', ['as'=>'post.random', 'uses'=>'PostController@random']);
                $router->get('/post/{post}/edit', ['as'=>'post.edit', 'uses'=>'PostController@edit']);
                $router->get('/', ['as'=>'post.home', 'uses'=>'PostController@home']);
            });
    });



//$routeConfigV2 = [
//    'namespace' => 'ErpNET\Models\v2\Controllers',
////            'prefix' => $this->app['config']->get('debugbar.route_prefix'),
//];
//
//$router
//    ->version('v2', function (Router $router) use ($routeConfigV2) {
//        $router
//            ->group($routeConfigV2, function (Router $router) {
//                $router->get('appVersion', [
//                    'as'=>'api.appVersion',
//                    'uses'=> 'ApiController@appVersion'
//                ]);
//            });
//
//    });