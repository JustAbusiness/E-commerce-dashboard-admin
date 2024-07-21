<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{

    public $bindings = [
        'App\Services\Interfaces\User\UserCatalogueServiceInterface' => 'App\Services\User\UserCatalogueService',

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

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
