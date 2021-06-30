<?php

namespace Mariojgt\Gateway;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Mariojgt\Gateway\Commands\Install;
use Mariojgt\Gateway\Commands\Republish;
use Mariojgt\Gateway\Events\UserVerifyEvent;
use Mariojgt\Gateway\Listeners\SendUserVerifyListener;

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
        $this->loadViewsFrom(__DIR__ . '/views', 'gateway');

        // Load gateway routes
        $this->loadRoutesFrom(__DIR__ . '/Routes/web.php');
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
        // Publish the public folder
        $this->publishes([
            __DIR__ . '/../Publish/Config/' => config_path('')
        ]);
    }
}
