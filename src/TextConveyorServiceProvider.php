<?php

namespace JeroenG\TextConveyor;

use Illuminate\Support\ServiceProvider;

class TextConveyorServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/formatters.php' => config_path('formatters.php'),
            ]);
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Assembler::class, function ($app) {
            return (new Assembler)->setFormatter($app['config']['formatters']['formatters']);
        });

        $this->mergeConfigFrom(
            __DIR__.'/../config/formatters.php', 'formatters'
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Assembler::class];
    }
}
