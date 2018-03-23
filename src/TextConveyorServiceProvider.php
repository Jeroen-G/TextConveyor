<?php

namespace JeroenG\TextConveyor;

use Illuminate\Support\ServiceProvider;

class TextConveyorServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('textconveyor', function ($app) {
            return new Assembler;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['textconveyor'];
    }
}
