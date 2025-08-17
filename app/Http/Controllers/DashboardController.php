<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Log;

class DashboardController extends Controller
{

    public function __construct(protected ProductService $productService, protected CategoryService $categoryService)
    {

    }

    public function index(Request $request)
    {
        $categories = $this->categoryService->getCategories();

        $products = $this->productService->getProductsWithoutCategory();

        return view('pages.dashboard', compact('categories', 'products'));
    }


    public function search(SearchRequest $request)
    {
        $products = $this->productService->searchProduct($request->search);

        return response()->json($products);
    }
}
