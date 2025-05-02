<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Log;

class DashboardController extends Controller
{

    public function __construct(public ProductService $productService)
    {

    }

    public function index(Request $request)
    {
        // Carrega as categorias com seus produtos
        $categories = Category::with('products')->get();

        // Inicia a query dos produtos
        $query = Product::query();

        // Adiciona where para produtos sem categoria
        $query->where('category_id', null);
        // Executa a query e armazena os resultados
        $products = $query->get();

        Log::info('Dashboard index', [
            'categories' => $categories,
            'products' => $products,
            'search' => $request->search,
        ]);

        // Retorna a view com os dados
        return view('pages.dashboard', compact('categories', 'products'));
    }


    public function search(Request $request)
    {
        // Inicia a query dos produtos
        $query = Product::query();

        $query->where('category_id', null);

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', "%$search%");
            });
        }

        $products = $query->get();

        // Retorna a view com os dados
        return response()->json($products);
    }

    public function likeProduct(Request $request, $id)
    {
        Log::info('Like product request', ['request' => $request->all(), 'id' => $id]);

        $product = $this->productService->likeProduct($request->category_id, $id);
        if (!$product) {
            return response()->json(['error' => 'Produto não encontrado'], 404);
        }
        return response()->json(['success' => 'Produto adicionado a categoria com sucesso']);
    }

    public function unlikeProduct($id)
    {
        Log::info('Unlike product request', ['id' => $id]);
        $product = $this->productService->unlikeProduct($id);
        if (!$product) {
            return response()->json(['error' => 'Produto não encontrado'], 404);
        }
        return response()->json(['success' => 'Produto removido da categoria com sucesso']);
    }
}
