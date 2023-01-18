<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Bonuse;
use Illuminate\Http\Request;

class IncentiveBonusController extends Controller
{
    public function index () {

        $incentive = Bonuse::where('bonus_type', 'incentive')
                            ->where('given_id', auth()->id())
                            ->where('status', false)
                            ->sum('amount');
        return view('frontend.contents.dashboard.incentive', ['incentive' => $incentive]);
    }
}
