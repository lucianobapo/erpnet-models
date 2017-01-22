<?php

namespace ErpNET\Models\Providers;

use Illuminate\Support\ServiceProvider;

class ErpnetModelsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $app = $this->app;

        $projectRootDir = __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR;
        $routesDir = $projectRootDir."routes".DIRECTORY_SEPARATOR;

        $configPath = $projectRootDir . 'config/erpnetModels.php';
        $this->mergeConfigFrom($configPath, 'erpnetModels');

        //Publish Config
        $this->publishes([
            $projectRootDir.'config/erpnetModels.php' => config_path('erpnetModels.php')
        ], 'config');

        //Bind Interfaces
        foreach (config('erpnetMigrates.tables') as $table => $config) {
            $routePrefix = isset($config['routePrefix'])?$config['routePrefix']:str_singular($table);
            $bindInterface = '\\ErpNET\\Models\\v1\\Interfaces\\'.(isset($config['bindInterface'])?$config['bindInterface']:(ucfirst(camel_case($routePrefix)).'Repository'));
            $bindRepository = '\\ErpNET\\Models\\v1\\Repositories\\'.(isset($config['bindRepository'])?$config['bindRepository']:(ucfirst(camel_case($routePrefix)).'RepositoryEloquent'));

            if(interface_exists($bindInterface)  && class_exists($bindRepository)){
                $app->bind($bindInterface, $bindRepository);
            }
        }

        $app->bind(\ErpNET\Models\v1\Interfaces\OrderService::class, \ErpNET\Models\v1\Services\OrderServiceEloquent::class);

        //Routing
        include $routesDir."api.php";
        include $routesDir."web.php";

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\Barryvdh\Cors\ServiceProvider::class);
        $this->app->register(\Dingo\Api\Provider\LaravelServiceProvider::class);
        $this->app->register(\Prettus\Repository\Providers\RepositoryServiceProvider::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
