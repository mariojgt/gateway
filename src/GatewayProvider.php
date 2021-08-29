<?php

namespace Mariojgt\Gateway;

use Illuminate\Support\Facades\Event;
use Mariojgt\Gateway\Commands\Install;
use Illuminate\Support\ServiceProvider;
use Mariojgt\Gateway\Commands\Republish;
use App\Events\StripeUsePaymentSuccessEvent;
use Mariojgt\Gateway\Events\UserVerifyEvent;
use App\Events\StripeUserSubscriptionCancelEvent;
use Mariojgt\Gateway\Listeners\SendUserVerifyListener;
use App\Listeners\StripeUsePaymentSuccessEventListener;
use App\Listeners\StripeUserSubscriptionCancelListener;

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

        // Stripe events
        // Weebhook for when the user cancel
        Event::listen(
            StripeUserSubscriptionCancelEvent::class,
            [StripeUserSubscriptionCancelListener::class, 'handle']
        );
        // Weebhook for when the user complete a payment
        Event::listen(
            StripeUsePaymentSuccessEvent::class,
            [StripeUsePaymentSuccessEventListener::class, 'handle']
        );
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

        // Publish custom middlewhere
        $this->publishes([
            __DIR__ . '/../Publish/middleware/' => app_path('Http/Middleware'),
        ]);

        // publish the events for the custom weebhooks
        $this->publishes([
            __DIR__ . '/../Publish/events/Events/' => app_path('Events/'),
        ]);

        // Publish the Listeners
        $this->publishes([
            __DIR__ . '/../Publish/events/Listeners/' => app_path('Listeners/'),
        ]);
    }
}
