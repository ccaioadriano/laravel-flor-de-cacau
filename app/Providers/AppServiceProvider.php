<?php

namespace App\Providers;

use App\Models\Order;
use Event;
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
        Event::listen(WebhookReceived::class, function (WebhookReceived $event) {
            switch ($event->payload['type']) {
                case 'checkout.session.completed':
                    $session = $event->payload['data']['object'];
                    
                    $order = Order::where('stripe_payment_id', $session['id'])->first();
                    
                case 'payment_intent.succeeded':
                    $session = $event->payload['data']['object'];
                    
                    $order = Order::where('stripe_payment_id', $session['id'])->first();
                    if ($order) {
                        $order->update(['status' => 'paid']);
                    }
                    break;

                case 'payment_intent.payment_failed':
                    $intent = $event->payload['data']['object'];

                    $order = Order::where('stripe_payment_id', $intent['id'])->first();
                    if ($order) {
                        $order->update(['status' => 'failed']);
                    }
                    break;
            }
        });
    }
}
