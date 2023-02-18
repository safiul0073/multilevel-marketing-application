<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Reward;
use App\Models\RewardUser;
use Illuminate\Http\Request;

class RewardController extends Controller
{

    public function index () {

        $rewards = Reward::with(['images','reward_users' => fn ($q) => $q->where('user_id', auth()->id())])
                           ->get();
        return view('frontend.contents.dashboard.reward_show',
            [
                'rewards' => $rewards,
            ]
        );
    }
}
