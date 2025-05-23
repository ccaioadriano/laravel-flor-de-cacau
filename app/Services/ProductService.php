<?php
namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use Cache;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class ProductService
{

    private const PER_PAGE = 9;

    public function getProducts($filter)
    {
        try {
            $products = Cache::remember('all_products', 60, function () {
                return Product::select(['id', 'title', 'description', 'price', 'image'])
                    ->latest()
                    ->get();
            });

            if ($filter !== 'all') {
                $productsByCategory = Category::where('slug', $filter)->first();
                return $productsByCategory->products()->paginate(self::PER_PAGE);
            }

            $currentPage = request()->get('page', 1);
            $items = $products->forPage($currentPage, self::PER_PAGE);

            return new LengthAwarePaginator(
                $items,
                $products->count(),
                self::PER_PAGE,
                $currentPage,
                [
                    'path' => request()->url(),
                    'query' => request()->query()
                ]
            );

        } catch (\Exception $e) {
            \Log::error('Erro ao buscar produtos: ' . $e->getMessage());

            $products = Product::select(['id', 'title', 'description', 'price', 'image'])
                ->latest()
                ->paginate(self::PER_PAGE);

            return $products;
        }
    }

    public function createProduct(array $data)
    {
        try {
            $data['price'] = (int)preg_replace('/[^0-9]/', '', $data['price']);
            $product = Product::create($data);

            if (array_key_exists('image', $data)) {

                Storage::disk('public')->putFileAs(
                    'images',
                    $data['image'],
                    $data['image']->getClientOriginalName()
                );
                $product->update(['image' => $data['image']->getClientOriginalName()]);
            }

            return $product;
        } catch (\Exception $e) {
            \Log::error('Erro ao criar produto: ' . $e->getMessage());
            return false;
        }
    }

    public function updateProduct($id, array $data)
    {
        try {
            $product = Product::findOrFail($id);
    
            if (array_key_exists('image', $data)) {
                Storage::disk('public')->putFileAs(
                    'images',
                    $data['image'],
                    $data['image']->getClientOriginalName()
                );
                $data['image'] = $data['image']->getClientOriginalName();
            }
    
            if (array_key_exists('price', $data)) {
                $data['price'] = (int)preg_replace('/[^0-9]/', '', $data['price']);
            }
    
            $product->update($data);
    
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

    public function searchProduct($search)
    {
        $query = Product::query();

        $query->where('category_id', null);

        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', "%$search%");
            });
        }
        return $query->get();
    }

    public function getProductsWithoutCategory()
    {
        return Product::where('category_id', null)
            ->get();
    }
}
