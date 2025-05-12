<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestCreateProduct;
use App\Http\Requests\RequestUpdateImage;
use App\Http\Requests\RequestUpdatePrice;
use App\Http\Requests\RequestUpdateProduct;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct(protected ProductService $productService, protected CategoryService $categoryService)
    {
    }

    public function index(Request $request)
    {
        $filter = $request->get('category', 'all');

        $products = $this->productService->getProducts($filter);

        $categories = $this->categoryService->getCategoriesWithProducts();

        return view('welcome', compact('products', 'categories'));
    }

    public function create()
    {
        return view('pages.product.create');
    }

    public function store(RequestCreateProduct $request) {
        $fields = $request->validated();

        $product = $this->productService->createProduct($fields);

        if (!$product) {
            return redirect()->back()->with('error', 'Falha ao criar o produto.');
        }

        return redirect()->route('home')->with('success', 'Produto criado com sucesso!');
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
