<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Checkout;

class CheckoutController extends Controller
{
    public function checkout(Request $request, ProductService $productService)
    {
        $items = $request->items; // array de itens do carrinho
        $lineItems = [];

        if (empty($items)) {
            return response()->json(['error' => 'Carrinho vazio'], 400);
        }

        foreach ($items as $item) {
            $product = $productService->getProductById($item['id']);
            if ($product) {
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'brl',
                        'product_data' => [
                            'name' => $product->title,
                            'images' => [$product->image ? asset('storage/images/' . $product->image) : asset('img/default.png')],
                        ],
                        'unit_amount' => intval($product->price * 100),
                    ],
                    'quantity' => $item['quantity'],
                ];
            } else {
                Log::warning('Produto não encontrado: ' . $item['id']);
                unset($item);
            }
        }

        // Criar a sessão de checkout com Cachier
        $session = Checkout::guest()->create($lineItems, [
            'payment_method_types' => ['card', 'boleto'],
            'mode' => 'payment',
            'success_url' => route('checkout-success'),
            'cancel_url' => route('home'),
            'metadata' => [
                'order_number' => strtoupper(uniqid('#')),
            ]
        ]);

        //cria o pedido com status 'pending'
        Order::create([
            'guest_id' => \Illuminate\Support\Str::uuid(),
            'order_number' => strtoupper(uniqid('#')),
            'status' => 'pending',
            'subtotal' => array_sum(array_map(fn($item) => $item['price_data']['unit_amount'] * $item['quantity'], $lineItems)),
            'total' => array_sum(array_map(fn($item) => $item['price_data']['unit_amount'] * $item['quantity'], $lineItems)), // aqui ainda sem descontos/frete
            'details' => $items,
            'stripe_payment_id' => $session->id, // importante!
        ]);

        return response()->json(['url' => $session->url]);
    }

    public function success()
    {
        return redirect()->route('home')->with('success', 'Pagamento realizado com sucesso!');
    }
}
