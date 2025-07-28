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
            if ($filter !== 'all') {
              
                $category = Category::with([
                    'products' => function ($query) {
                        $query->select(['id', 'title', 'description', 'price', 'image', 'category_id'])
                            ->latest();
                    }
                ])->where('slug', $filter)->first();

                if (!$category) {
                    throw new \Exception('Categoria não encontrada: ' . $filter);
                }

                // Usa paginação direta do relacionamento
                return $category->products()
                    ->select(['id', 'title', 'description', 'price', 'image'])
                    ->latest()
                    ->paginate(self::PER_PAGE);
            }

            // Para 'all', usa cache com paginação direta
            return Product::select(['id', 'title', 'description', 'price', 'image'])
                ->latest()
                ->paginate(self::PER_PAGE);

        } catch (\Exception $e) {
            \Log::error('Erro ao buscar produtos: ' . $e->getMessage());

            return Product::select(['id', 'title', 'description', 'price', 'image'])
                ->latest()
                ->paginate(self::PER_PAGE);
        }
    }

    public function createProduct(array $data)
    {
        try {
            $data['price'] = (int) preg_replace('/[^0-9]/', '', $data['price']);
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
                $data['price'] = (int) preg_replace('/[^0-9]/', '', $data['price']);
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
