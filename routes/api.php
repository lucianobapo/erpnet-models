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
            ->group($routeConfigV1, function (Router $router) use ($routeConfigV1) {
                $router->get('appVersion', [
                    'as'=>'api.appVersion',
                    'uses'=> 'ApiController@appVersion'
                ]);

                foreach (config('erpnetMigrates.tables') as $table => $config) {
                    $routePrefix = isset($config['routePrefix'])?$config['routePrefix']:str_singular($table);
                    $routeController = isset($config['routeController'])?$config['routeController']:(ucfirst(camel_case($routePrefix)).'Controller');
                    if(class_exists($routeConfigV1['namespace'].'\\'.$routeController)){
                        $router->resource($routePrefix, $routeController);
                        $router->get('/'.$routePrefix.'/{'.$routePrefix.'}/edit', ['as'=>$routePrefix.'.edit', 'uses'=>$routeController.'@edit']);
                    }
                }

                $router->delete('/order/{order}/finish', ['as'=>'order.finish','uses'=> 'OrderController@finish']);
                $router->delete('/order/{order}/cancel', ['as'=>'order.cancel','uses'=> 'OrderController@cancel']);
                
                $router->get('/delivery-service', ['as'=>'delivery.package','uses'=> 'DeliveryServiceController@package']);
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