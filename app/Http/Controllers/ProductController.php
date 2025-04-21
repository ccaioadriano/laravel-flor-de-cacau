<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request){

        $products = Product::select(['title', 'description', 'price', 'image'])->paginate(9);

        return view('welcome', compact('products'));
    }
}
