<?php

namespace Clicko\SpiderClicko;

use Illuminate\Support\ServiceProvider;

class SpiderClickoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Clicko\SpiderClicko\SpiderClickoController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->commands([
            InstallCommand::class,
        ]);
    }
}
