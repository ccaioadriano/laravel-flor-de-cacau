<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Log;

class StripeWebhookController extends Controller
{

    public function handlePaymentSuccess(Request $request)
    {
        try {
            Order::where('stripe_payment_id', $request->data['object']['id'])->update([
                'status' => 'paid',
                'paid_at' => now(),
            ]);
        } catch (\Throwable $th) {
            Log::error('Error updating order status: ' . $th->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Failed to update order status'], 500);
        }

        return response()->json(['status' => 'success']);
    }
}
