<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index (Request $request) {
        $search = $request->search;
        $category_id = $request->category_id;
        $query = Product::query()->orderBy('id', "desc");

        if ($request->search) {
            $query->whereLike(['name', 'price', 'refferral_commission'], $request->search);
        }

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }
        $products = $query->paginate(50);
        $categories = Category::where('status', 1)->get();
        return view('frontend.contents.products.index', compact(
            'products',
            'categories',
            'search',
            'category_id'
        ));
    }
}
