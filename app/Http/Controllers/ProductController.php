<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    private const PER_PAGE = 9;
    private const CACHE_DURATION = 60;

    public function index(Request $request)
    {
        try {
            // Pega página atual com valor default
            $page = $request->get('page', 1);

            // Gera chave única do cache
            $cacheKey = "products:page:{$page}:" . now()->format('Y-m-d');

            $products = Cache::remember($cacheKey, self::CACHE_DURATION, function () {
                return Product::select(['id', 'title', 'description', 'price', 'image'])
                    ->latest()
                    ->paginate(self::PER_PAGE);
            });

            return view('welcome', compact('products'));

        } catch (\Exception $e) {
            \Log::error('Erro ao buscar produtos: ' . $e->getMessage());

            // Fallback em caso de erro no cache
            $products = Product::select(['id', 'title', 'description', 'price', 'image'])
                ->latest()
                ->paginate(self::PER_PAGE);

            return view('welcome', compact('products'));
        }
    }
}
