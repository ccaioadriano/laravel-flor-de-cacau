<?php
namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductService
{

    private const PER_PAGE = 9;

    public static function getProducts($filter)
    {

        try {

            $query = Product::query();

            if ($filter !== 'all') {
                $query->where('category', $filter)->paginate(self::PER_PAGE);
            }

            $products = $query->paginate(self::PER_PAGE);

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

    public static function updateProduct($id, array $data)
    {
        try {
            $product = Product::findOrFail($id);
            $product->update($data);

            return $product;
        } catch (\Exception $e) {
            \Log::error('Erro ao atualizar produto: ' . $e->getMessage());
            return null;
        }
    }
}
