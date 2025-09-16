<?php

namespace App\Providers;

use App\Listeners\StripeEventListener;
use App\Models\Order;
use Event;
use Illuminate\Broadcasting\BroadcastServiceProvider;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Events\WebhookReceived;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            StripeEventListener::class
        );
    }
}
