<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Bonuse;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Reward;
use App\Models\Slider;
use App\Models\User;
use App\Models\Withdraw;
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

        $reward_users = User::select('id', 'first_name', 'last_name')->with(['image', 'rewards' => fn ($q) => $q->orderBy('left_count', 'desc')])
                              ->withCount('reward_users as user_reward_count')
                              ->has('reward_users')
                              ->orderByDesc('user_reward_count')->limit(10)->get();
        $rewards = Reward::all();

        $latest_withdraws = Withdraw::with(['user:id,first_name,last_name'])->where('status', 1)
                            ->latest('updated_at')
                            ->select('user_id', 'method_name', 'created_at', 'amount')
                            ->limit(5)->get();
        $latest_purchase = Purchase::with('user:id,first_name,last_name')
                           ->where(['status' => 1, 'type' => 1])
                           ->latest('id')
                           ->select('product_name', 'amount', 'created_at', 'user_id')
                           ->limit(5)->get();
        $top_sponsor = User::select('id', 'first_name', 'last_name', 'sponsor_id', 'created_at')
                            ->with('sponsor:id,first_name,last_name')
                            ->withCount(['bonuses as sponsor_count' => fn ($q) =>$q->where('bonus_type', Bonuse::JOINING)])
                            ->orderByDesc('sponsor_count')->limit(5)->get();

        return view('frontend.contents.home.index', [
            'products' => $products->orderBy('id', 'desc')->take(8)->get(),
            'sliders'   => $sliders,
            'reward_users' => $reward_users,
            'rewards' => $rewards,
            'latest_withdraws' => $latest_withdraws,
            'latest_purchase' => $latest_purchase,
            'top_sponsor' => $top_sponsor
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
