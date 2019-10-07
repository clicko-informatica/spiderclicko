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
        $this->mergeConfigFrom( __DIR__.'/config/spiderclicko.php', 'spiderclicko');
        $this->app->make('Clicko\SpiderClicko\SpiderClickoController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->publishes([
            __DIR__.'/config/spiderclicko.php' => config_path('spiderclicko.php'),
        ], 'config');
        $this->commands([
            InstallCommand::class,
        ]);
    }
}
