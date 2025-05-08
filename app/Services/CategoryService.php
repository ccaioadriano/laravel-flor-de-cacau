<?php
namespace App\Services;

use App\Models\Category;
use App\Models\Product;

class CategoryService
{
    public function getCategories()
    {
        return Category::with('products')
            ->select(['id', 'name', 'slug'])
            ->get();
    }

    public function getCategoriesWithProducts()
    {
        return Category::whereIn('id', Product::where('category_id', '!=', 'null')->pluck('category_id'))
            ->select(['id', 'name', 'slug'])
            ->get();
    }
}
