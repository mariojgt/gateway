<?php

namespace mariojgt\checkout;

use Illuminate\Support\ServiceProvider;

use Config;

class checkoutServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        //login Middleware is you have any
        $router->aliasMiddleware('CheckAuth', 'mariojgt\checkout\Middleware\CheckAuth::class');
        $router->aliasMiddleware('CheckGuest', 'mariojgt\checkout\Middleware\CheckGuest::class');
        $this->loadViewsFrom(__DIR__.'/views', 'checkout');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Push config and assets to main Laravel config
        $this->publishes([
            __DIR__.'/Assets' => public_path('vendor/checkout/'),
            __DIR__.'/Config/checkoutConfig.php' => config_path('checkout.php'),
        ]);

        // Overide the auth config to match our own
        //Config::set('auth', include(__DIR__.'/Config/auth.php'));
        //Config::set('variables', include(__DIR__.'/Config/variables.php'));

        // Load Routes
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/Routes/api.php');

        // Load layouts
        $this->loadViewsFrom(__DIR__.'/Views', 'checkout');

        // Load global migrations
        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');

        //loading all the helper so in this way we dont need to include them
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();

        $helpers = scandir(__DIR__.'/Helpers');
        //in here we read the files in the folder and setup the alias
        foreach ($helpers as $key => $files) {
            $pieces = explode(".", $files);
            $classConcatName = '\\'.$pieces[0];
            if (end($pieces) == 'php') {
                //the alias is alyes the class name
                $loader->alias($pieces[0], 'mariojgt\unityframework\Helpers'.$classConcatName);
            }
        }
    }
}
