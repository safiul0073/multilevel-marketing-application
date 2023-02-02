<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Slider;
use App\Models\User;
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

        $sliders = Slider::where('status', 1)->get();

        $reward_users = User::select('id', 'username')->with(['image', 'rewards' => fn ($q) => $q->orderBy('left_count', 'desc')->limit(1)])
                              ->withCount('reward_users as user_reward_count')
                              ->has('reward_users')
                              ->orderByDesc('user_reward_count')->limit(10)->get();

        return view('frontend.contents.home.index', [
            'products' => $products->orderBy('id', 'desc')->take(8)->get(),
            'sliders'   => $sliders,
            'reward_users' => $reward_users
        ]);
    }

    public function responseProductData (Request $request) {
        if (request()->json()) {
            $id = $request->id;
            $product = Product::with('images', 'category:id,title')->find((int) $id);
            return response()->json($product);
        }
    }
}
