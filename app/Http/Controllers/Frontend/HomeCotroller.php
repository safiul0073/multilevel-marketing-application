<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeCotroller extends Controller
{
    public function index()
    {
        $products = Product::query()->with(['images' => function ($q) {
            $q->where('type', 'thamnail');
        }]);
        if (auth()->check()) {
            $products->where('is_package', 0);
        }

        return view('frontend.contents.home.index', ['products' => $products->orderBy('id', 'desc')->take(8)->get()]);
    }

    public function responseProductData (Request $request) {
        if (request()->json()) {
            $id = $request->id;
            $product = Product::with('images', 'category:id,title')->find((int) $id);
            return response()->json($product);
        }
    }
}
