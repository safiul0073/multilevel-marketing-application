<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RewardController extends Controller
{

    public function index () {

        return view('frontend.contents.dashboard.reward_show');
    }
}
