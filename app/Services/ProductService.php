<?php
namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductService
{

    private const PER_PAGE = 9;
    private const CACHE_DURATION = 60;


    public static function getProducts($page)
    {
        try {
            // Gera chave única do cache
            $cacheKey = "products:page:{$page}:" . now()->format('Y-m-d');

            $products = Cache::remember($cacheKey, self::CACHE_DURATION, fn() => 
                Product::select(['id', 'title', 'description', 'price', 'image'])
                    ->latest()
                    ->paginate(self::PER_PAGE)
            );

            return $products;

        } catch (\Exception $e) {
            \Log::error('Erro ao buscar produtos: ' . $e->getMessage());

            // Fallback em caso de erro no cache
            $products = Product::select(['id', 'title', 'description', 'price', 'image'])
                ->latest()
                ->paginate(self::PER_PAGE);

            return $products;
        }
    }

}
