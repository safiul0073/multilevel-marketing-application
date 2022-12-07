<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index () {

        $products = Product::orderBy('id', "desc")->paginate(20);
        $categories = Category::where('status', 1)->get();
        return view('frontend.contents.products.index', compact('products', 'categories'));
    }
}
