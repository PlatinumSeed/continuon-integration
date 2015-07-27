<?php

namespace Platinumseed\Continuon;

use Illuminate\Support\ServiceProvider;

class ContinuonServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/continuon.php' => config_path('/continuon/continuon.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
