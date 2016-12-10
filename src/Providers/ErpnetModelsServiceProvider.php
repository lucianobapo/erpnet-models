<?php

namespace ErpNET\Models\Providers;

use ErpNET\Models\v1\Interfaces\MandanteRepository;
use ErpNET\Models\v1\Interfaces\OrderRepository;
use ErpNET\Models\v1\Interfaces\PartnerRepository;
use ErpNET\Models\v1\Interfaces\PostRepository;
use ErpNET\Models\v1\Repositories\MandanteRepositoryEloquent;
use ErpNET\Models\v1\Repositories\OrderRepositoryEloquent;
use ErpNET\Models\v1\Repositories\PartnerRepositoryEloquent;
use ErpNET\Models\v1\Repositories\PostRepositoryEloquent;
use Illuminate\Routing\Router;
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
        $projectRootDir = __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR;
        $routesDir = $projectRootDir."routes".DIRECTORY_SEPARATOR;

        $app = $this->app;

        //Publish Config
//        $configPath = __DIR__ . '/../config/debugbar.php';
//        $this->publishes([$configPath => $this->getConfigPath()], 'config');

        //Bind Interfaces
        $app->bind(PartnerRepository::class, PartnerRepositoryEloquent::class);
        $app->bind(OrderRepository::class, OrderRepositoryEloquent::class);
        $app->bind(MandanteRepository::class, MandanteRepositoryEloquent::class);
        $app->bind(PostRepository::class, PostRepositoryEloquent::class);

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
        $this->app->register(\Dingo\Api\Provider\LaravelServiceProvider::class);
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
