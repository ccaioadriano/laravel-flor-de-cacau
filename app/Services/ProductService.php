<?php
namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use Cache;
use Illuminate\Support\Facades\Storage;

class ProductService
{

    private const PER_PAGE = 9;

    public function getProducts($filter)
    {
        try {
            $products = Cache::remember('products', 60, function () {
                return Product::select(['id', 'title', 'description', 'price', 'image'])
                    ->latest()
                    ->get();
            });

            if ($filter !== 'all') {
                $productsByCategory = Category::where('slug', $filter)->first();
                return $productsByCategory->products()->paginate(self::PER_PAGE);
            }

            return $products->paginate(self::PER_PAGE);

        } catch (\Exception $e) {
            \Log::error('Erro ao buscar produtos: ' . $e->getMessage());

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
                $product->update(['price' => $price]);
            } else {
                $product->update($data);
            }

            return $product;
        } catch (\Exception $e) {
            \Log::error('Erro ao atualizar produto: ' . $e->getMessage());
            return false;
        }
    }

    public function deleteProduct($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return true;
        } catch (\Exception $e) {
            \Log::error('Erro ao deletar produto: ' . $e->getMessage());
            return false;
        }
    }


    public function linkProduct($categoryId, $productId)
    {
        try {
            $product = Product::findOrFail($productId);
            $category = Category::findOrFail($categoryId);
            $product->update(['category_id' => $category->id]);
            return true;
        } catch (\Throwable $e) {
            \Log::error('Erro ao vincular produto: ' . $e->getMessage());
            return false;
        }
    }

    public function unlinkProduct($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->update(['category_id' => null]);
            return true;
        } catch (\Exception $e) {
            \Log::error('Erro ao desvincular produto: ' . $e->getMessage());
            return false;
        }
    }
}
