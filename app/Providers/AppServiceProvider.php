<?php

namespace App\Providers;

use Illuminate\Http\Testing\File;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;
use Illuminate\Filesystem\Filesystem;


class AppServiceProvider extends ServiceProvider
{

    public $bindings = [
        'App\Services\Interfaces\User\UserCatalogueServiceInterface' => 'App\Services\User\UserCatalogueService',
        'App\Services\Interfaces\User\UserServiceInterface' => 'App\Services\User\UserService',

        'App\Services\Interfaces\Product\ProductCatalogueServiceInterface' => 'App\Services\Product\ProductCatalogueService',
        'App\Services\Interfaces\Product\ProductServiceInterface' => 'App\Services\Product\ProductService',

        'App\Services\Interfaces\Attribute\AttributeCatalogueServiceInterface' => 'App\Services\Attribute\AttributeCatalogueService',

        'App\Services\Interfaces\Tax\TaxServiceInterface' => 'App\Services\Tax\TaxService',

    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Sanctum::getAccessTokenFromRequestUsing(function($request) {
        //     return $request->cookie('backend_token');
        // });

        foreach($this->bindings as $key => $val) {
            $this->app->bind($key,$val);
        }

        $this->app->register(\App\Providers\RepositoryServiceProvider::class);

        $this->app->singleton('League\Glide\Server', function ($app) {
            $filesystem = $app->make(Filesystem::class);
            $sourcePath = storage_path('uploads');
            $cachePath = storage_path('app/public/cache');

            // return ServerFactory::create([
            //     'source' => $filesystem->getDriver(),
            //     'cache' => $filesystem->getDriver(),
            //     'source_path_prefix' => $sourcePath,
            //     'cache_path_prefix' => $cachePath,
            //     'base_url' => 'img',
            // ]);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
