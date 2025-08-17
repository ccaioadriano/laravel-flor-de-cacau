<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
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
                \Log::warning('Produto não encontrado: ' . $item['id']);
                unset($item);
            }
        }

        // Criar a sessão de checkout com Cachier
        $session = Checkout::guest()->create($lineItems, [
            'payment_method_types' => ['card', 'boleto'],
            'mode' => 'payment',
            'success_url' => route('checkout-success'),
            'cancel_url' => route('home'),
        ]);

        return response()->json(['url' => $session->url]);
    }

    public function success()
    {
        return redirect()->route('home')->with('success', 'Pagamento realizado com sucesso!');
    }
}
