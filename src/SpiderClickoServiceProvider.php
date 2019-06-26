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

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->commands([
            InstallCommand::class,
        ]);
    }
}
