<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Log;

class StripeWebhookController extends Controller
{

    public function handlePaymentSuccess(Request $request)
    {
        // Aqui você pode processar o webhook do Stripe
        // Por exemplo, verificar o tipo de evento e tomar ações apropriadas

        Log::info('Stripe Webhook Received', [
            'event' => $request->all(),
        ]);
        

        return response()->json(['status' => 'success']);
    }
}
