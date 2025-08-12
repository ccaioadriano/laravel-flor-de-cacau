<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\StripeClient;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        //criar uma config de checkout
        $stripe = new StripeClient(config('stripe.secret'));

        $items = $request->items; // array de itens do carrinho

        $lineItems = [];

        foreach ($items as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'brl',
                    'product_data' => [
                        'name' => $item['title'],
                        'images' => [$item['image']],
                    ],
                    'unit_amount' => intval($item['price'] * 100), // centavos
                ],
                'quantity' => $item['quantity'],
            ];
        }

        $session = $stripe->checkout->sessions->create([
            'line_items' => $lineItems,
           'payment_method_types' => ['card', 'boleto'],
            'mode' => 'payment',
            'success_url' => route('checkout-success'),
            'cancel_url' => route('checkout-cancel'),
        ]);

        return response()->json(['url' => $session->url]);
    }

    public function success()
    {

        // Salvar informações do pedido no DB 
        // Manda email de confirmação
        // Criar um job para enviar a mensagem com o pedido para o administrador

        return redirect()->route('home')->with('success', 'Pagamento realizado com sucesso!');
    }

}
