<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
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

        $order = new Order();
        $order->guest_id = Str::uuid();
        $order->order_number = uniqid('order_');


        // Criar a sessão de checkout
        $session = Checkout::guest()->create($lineItems, [
            'payment_method_types' => ['card', 'boleto'],
            'mode' => 'payment',
            'success_url' => route('checkout-success') . '?order_number=' . $order->order_number,
            'cancel_url' => route('home'),
        ]);

        $order->stripe_session_id = $session->id;
        $order->stripe_payment_id = $session->payment_intent ?? null;
        $order->status = 'pending';
        $order->subtotal = array_sum(array_map(fn($item) => $item['price_data']['unit_amount'] * $item['quantity'], $lineItems));
        $order->total = array_sum(array_map(fn($item) => $item['price_data']['unit_amount'] * $item['quantity'], $lineItems));
        $order->details = $items;

        $order->save();

        return response()->json(['url' => $session->url]);
    }

    public function success(Request $request)
    {
        $orderNumber = $request->get('order_number');

        $order = Order::where('order_number', $orderNumber)->first();

        return view('pages.checkout.feedback', compact('order'));
    }
}
