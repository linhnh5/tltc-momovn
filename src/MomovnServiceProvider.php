<?php

namespace Tltc\Momovn\Providers;

use Illuminate\Support\ServiceProvider;

class MomovnServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function register()
    {
        //
        $this->mergeConfigFrom(__DIR__.'/config/momo.php', 'momovn');
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->app->make('Tltc\Momovn\Controllers\TestController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->publishes([
            __DIR__.'/config/momo.php' => config_path('momovn.php'),
        ]);
    }
}
