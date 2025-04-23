<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $filter = $request->get('category', 'all');

        $products = $this->productService->getProducts($filter);

        return view('welcome', compact('products'));
    }

    public function update(Request $request, $id)
    {
        $product = $this->productService->updateProduct($id, $request->all());

        if(!$product) {
            return redirect()->back()->with('error', 'Falha ao atualizar o produto.');
        }

        return redirect()->route('home')->with('success', 'Produto atualizado com sucesso!');
    }
}
