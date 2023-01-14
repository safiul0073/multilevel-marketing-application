<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Bonuse;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    public function index () {

        $referrals = Bonuse::with('bonus_for:id,first_name,last_name,username,phone,email,created_at')
                    ->where('given_id', auth()->id())->where('bonus_type', 'joining')->paginate(10);
        return view('frontend.contents.dashboard.referral_list', ['referrals' => $referrals]);
    }
}
