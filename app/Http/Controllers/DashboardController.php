<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Log;

class DashboardController extends Controller
{

    public function __construct(protected ProductService $productService)
    {

    }

    public function index(Request $request)
    {
        $categories = Category::with('products')->get();

        $query = Product::query();

        $query->where('category_id', null);

        $products = $query->get();

        return view('pages.dashboard', compact('categories', 'products'));
    }


    public function search(Request $request)
    {
        $query = Product::query();

        $query->where('category_id', null);

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', "%$search%");
            });
        }

        $products = $query->get();

        return response()->json($products);
    }

    public function linkProduct(Request $request, $id)
    {

        $product = $this->productService->linkProduct($request->category_id, $id);
        if (!$product) {
            return response()->json(['error' => 'Produto não encontrado'], 404);
        }
        return response()->json(['success' => 'Produto adicionado a categoria com sucesso']);
    }

    public function unlinkProduct($id)
    {
        $product = $this->productService->unlinkProduct($id);
        if (!$product) {
            return response()->json(['error' => 'Produto não encontrado'], 404);
        }
        return response()->json(['success' => 'Produto removido da categoria com sucesso']);
    }
}
