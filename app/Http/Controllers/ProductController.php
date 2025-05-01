<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestUpdateImage;
use App\Http\Requests\RequestUpdatePrice;
use App\Http\Requests\RequestUpdateProduct;
use App\Models\Category;
use App\Models\Product;
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

        $categories = Category::whereIn('id', Product::where('category_id', '!=', 'null')->pluck('category_id'))
            ->select(['id', 'name', 'slug'])
            ->get();

        return view('welcome', compact('products', 'categories'));
    }

    public function updateProduct(RequestUpdateProduct $request, $id)
    {
        $fields = $request->validated();
        $product = $this->productService->updateProduct($id, $fields);

        if (!$product) {
            return redirect()->back()->with('error', 'Falha ao atualizar o produto.');
        }

        return redirect()->route('home')->with('success', 'Produto atualizado com sucesso!');
    }

    public function updateImage(RequestUpdateImage $request, $id)
    {
        $fields = $request->validated();

        $product = $this->productService->updateProduct($id, $fields);


        if (!$product) {
            return redirect()->back()->with('error', 'Falha ao atualizar o produto.');
        }

        return redirect()->route('home')->with('success', 'Produto atualizado com sucesso!');
    }

    public function updatePrice(RequestUpdatePrice $request, $id)
    {
        $fields = $request->validated();

        $product = $this->productService->updateProduct($id, $fields);

        if (!$product) {
            return redirect()->back()->with('error', 'Falha ao atualizar o produto.');
        }

        return redirect()->route('home')->with('success', 'Produto atualizado com sucesso!');
    }

    public function deleteProduct($id)
    {
        $product = $this->productService->deleteProduct($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Falha ao deletar o produto.');
        }
        return redirect()->route('home')->with('success', 'Produto deletado com sucesso!');
    }
}
