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

        $page = $request->get('page', 1);

        $filter = $request->get('category', 'all');

        $products = $this->productService->getProducts($page, $filter);

        return view('welcome', compact('products'));
    }
}
