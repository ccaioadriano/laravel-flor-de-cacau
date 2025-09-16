<?php

namespace App\Listeners;

use App\Events\OrderStatusUpdated;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Checkout;
use Laravel\Cashier\Events\WebhookReceived;



// TODO: Implementar tratativas de erro e logging

class StripeEventListener
{

    /**
     * Handle the event.
     */
    public function handle(WebhookReceived $event): void
    {
        $payload = $event->payload;

        switch ($payload['type']) {
            case 'checkout.session.completed':
                $session = $payload['data']['object'];

                $order = Order::where('stripe_session_id', $session['id'])->first();

                if (isset($order) && $order->isPaymentProcessed == 0) {
                    $order->stripe_payment_id = $session['payment_intent'];
                    $order->status = 'processing';
                    $order->save();
                    OrderStatusUpdated::dispatch($order);
                }

                break;

            case 'payment_intent.succeeded':
                $paymentIntentId = $payload['data']['object']['id'];

                $order = Order::where('stripe_payment_id', $paymentIntentId)->first();

                if (!$order) {
                    // busca sessão vinculada a esse intent
                    $sessions = Cashier::stripe()->checkout->sessions->all([
                        'payment_intent' => $paymentIntentId,
                        'limit' => 1,
                    ]);

                    if (isset($sessions) && count($sessions->data) > 0) {
                        $session = $sessions->data[0];
                        $order = Order::where('stripe_session_id', $session->id)->first();

                        if ($order) {
                            $order->stripe_payment_id = $paymentIntentId;
                            $order->is_payment_processed = 1; //criar enum;
                            $order->status = 'paid';
                            $order->paid_at = now();
                            $order->save();

                        }
                    }
                }

                if (isset($order) && $order->isPaymentProcessed == 0) {
                    $order->is_payment_processed = 1;
                    $order->status = 'paid';
                    $order->paid_at = now();
                    $order->save();
                }

                break;

            case 'payment_intent.payment_failed':
                Log::warning("Payment failed: " . $payload['data']['object']['id']);
                $order = Order::where('stripe_payment_id', $payload['data']['object']['id'])->first();
                $order->status = 'failed';
                $order->save();
                event(new OrderStatusUpdated($order));
                break;
        }
    }
}
