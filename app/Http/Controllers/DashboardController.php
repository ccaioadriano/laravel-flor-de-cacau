<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Log;

class DashboardController extends Controller
{

    public function __construct(public ProductService $productService)
    {
        
    }
    public function index()
    {

        $categories = Category::all();

        return view('pages.dashboard', compact('categories'));
    }


    public function unlikeProduct($id)
    {
        $product = $this->productService->unlikeProduct($id);
        if (!$product) {
            return response()->json(['error' => 'Produto não encontrado'], 404);
        }
        return response()->json(['success' => 'Produto removido da categoria com sucesso']);
    }
}
