<?php
namespace Mariojgt\Gateway;

use Illuminate\Support\ServiceProvider;

class GatewayProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Load gateway views
        $this->loadViewsFrom(__DIR__.'/views', 'gateway');
        // Load gateway routes
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->publish();
    }

    public function publish()
    {
        //publish the npm case we need to do soem developent
        // $this->publishes([
        //     __DIR__.'/../Publish/Npm/' => base_path()
        // ]);

        // publish the resource in case we need to compile
        // $this->publishes([
        //     __DIR__.'/../Publish/Resource/' => resource_path('vendor/Peach/')
        // ]);

        // Publish the gateway config file
        $this->publishes([
            __DIR__.'/../Publish/Config/' => base_path('config/')
        ]);
    }
}
