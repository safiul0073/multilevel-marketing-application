<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeCotroller extends Controller
{
    public function index()
    {
        $products = Product::with(['images' => function ($q) {
            $q->where('type', 'thamnail');
        }])->orderBy('id', 'desc')->take(8)->get();


        return view('frontend.contents.home.index', compact('products'));
    }

    public function responseProductData (Request $request) {
        if (request()->json()) {
            $id = $request->id;
            $product = Product::with('images', 'category:id,title')->find((int) $id);
            return response()->json($product);
        }
    }
}
