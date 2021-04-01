<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * 引入客製化provider(\App\Privider\ClientProvider.php)，
         * 將原本jwt認證user的password改為client_secret
         * (override UserProvider)
         */
        \Illuminate\Support\Facades\Auth::provider('clientprovider', function($app, array $config) {
            return new ClientProvider($app['hash'], $config['model']);
        });
    }
}
