<?php
namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductService
{

    private const PER_PAGE = 9;

    public function getProducts($filter)
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

    public function updateProduct($id, array $data)
    {
        try {
            $product = Product::findOrFail($id);

            if (array_key_exists('image', $data)) {

                //armazena no storage
                Storage::disk('public')->putFileAs(
                    'images',
                    $data['image'],
                    $data['image']->getClientOriginalName()
                );
                $product->update(['image' => $data['image']->getClientOriginalName()]);
            } elseif (array_key_exists('price', $data)) {
                $price = preg_replace('/[^0-9]/', '', $data['price']);
                $product->update(['price'=>$price]);
            } else {
                $product->update($data);
            }

            return $product;
        } catch (\Exception $e) {
            \Log::error('Erro ao atualizar produto: ' . $e->getMessage());
            return null;
        }
    }
}
