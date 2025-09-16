<?php
namespace App\Services;

use App\Models\Category;
use App\Models\Product;

class CategoryService
{
    public function getCategories()
    {
        return Category::query()->select(['id', 'name', 'slug'])
            ->get();
    }
}
