<?php

namespace Mariojgt\Gateway;

use Illuminate\Support\Facades\Event;
use Mariojgt\Gateway\Commands\Install;
use Illuminate\Support\ServiceProvider;
use Mariojgt\Gateway\Commands\Republish;
use App\Events\StripeUserPaymentSuccessEvent;
use Mariojgt\Gateway\Events\UserVerifyEvent;
// Stripe weebwooks events
use App\Events\StripeUserSubscriptionCancelEvent;
use App\Events\StripeUserSubscriptionSuccessEvent;
use App\Listeners\StripeUserSubscriptionSuccessListener;
use App\Listeners\StripeUserPaymentSuccessListener;
use App\Listeners\StripeUserSubscriptionCancelListener;

// Go cardless webwook events
use App\Events\GocardlessUserSubscriptionSuccessEvent;
use App\Listeners\GocardlessUserSubscriptionSuccessListener;
use App\Events\GocardlessUserSubscriptionCancelEvent;
use App\Listeners\GocardlessUserSubscriptionCancelListener;
use App\Events\GocardlessUserPaymentErrorEvent;
use App\Listeners\GocardlessUserPaymentErrorListener;

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
        if (config('gateway.demo_mode')) {
            $this->loadRoutesFrom(__DIR__ . '/Routes/demo_web.php');
        }

        // Stripe Weebhooks
        if (config('gateway.stripe_weebhook_enable')) {
            // Load the stripe weebhooks events
            $this->registerStripeWeebhooksEventsAndRoute();
        }

        // Gocardless Weebhooks
        if (config('gateway.gocardless_weebhook_enable')) {
            // Load the gocardless weebhooks events
            $this->registerGocardlessWeebhooksEventsAndRoute();
        }
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

    /**
     * Register the stripe gateway weebhooks
     * those events can be changes once publish to the front end
     * also register the route
     *
     * @return [type]
     */
    public function registerStripeWeebhooksEventsAndRoute()
    {
        // Load the weebhooke route
        $this->loadRoutesFrom(__DIR__ . '/Routes/stripeweb.php');

        // Stripe events
        // Weebhook for when the user cancel
        Event::listen(
            StripeUserSubscriptionCancelEvent::class,
            [StripeUserSubscriptionCancelListener::class, 'handle']
        );

        // Weebhook for when the user complete a payment
        Event::listen(
            StripeUserPaymentSuccessEvent::class,
            [StripeUserPaymentSuccessListener::class, 'handle']
        );

        // Weebhooke for when the user review or compelte a subscprtion
        Event::listen(
            StripeUserSubscriptionSuccessEvent::class,
            [StripeUserSubscriptionSuccessListener::class, 'handle']
        );
    }

    /**
     * Register the gocardless gateway weebhooks
     * those events can be changes once publish to the front end
     * also register the route
     *
     * @return [type]
     */
    public function registerGocardlessWeebhooksEventsAndRoute()
    {
        // Load the weebhooke route
        $this->loadRoutesFrom(__DIR__ . '/Routes/gocardweb.php');

        // Gocardless weebhoock events
        // Weebhook for when the user confirm Subscription
        Event::listen(
            GocardlessUserSubscriptionSuccessEvent::class,
            [GocardlessUserSubscriptionSuccessListener::class, 'handle']
        );

        // Weebhook for when the user cancel Subscrption
        Event::listen(
            GocardlessUserSubscriptionCancelEvent::class,
            [GocardlessUserSubscriptionCancelListener::class, 'handle']
        );

        // Event from when the user have a canceled payment
        Event::listen(
            GocardlessUserPaymentErrorEvent::class,
            [GocardlessUserPaymentErrorListener::class, 'handle']
        );
    }
}
