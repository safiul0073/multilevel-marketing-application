<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Bonuse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IncentiveBonusController extends Controller
{

    public function index () {

        $incentive = Bonuse::where('bonus_type',Bonuse::INCENTIVE)
                            ->where('given_id', auth()->id())
                            ->where('status', false)
                            ->sum('amount');
        return view('frontend.contents.dashboard.incentive', ['incentive' => $incentive]);
    }

    public function addToWallet (Request $request) {

        $this->validate($request, [
           'amount' => 'required|numeric'
        ]);

        $request_amount = floatval($request->amount);
        $auth_id = auth()->id();
        $incentive_bonus = Bonuse::where('given_id', $auth_id)
                                   ->where('bonus_type', Bonuse::INCENTIVE)
                                   ->where('status', false)
                                   ->sum('amount');
        dd($incentive_bonus-$request_amount);
        if ($incentive_bonus != (float) $request_amount){
            return redirect()->back()->with(['error' => 'Bonus not match']);
        }

        if (config('mlm.bonus.incentive') > $incentive_bonus) {
            return redirect()->back()->with(['error' => 'Incentive bonus not full fil.']);
        }
        try {
           DB::beginTransaction();
           $user = User::find($auth_id);
           $user->balance = $user->balance + $incentive_bonus;
           $user->save();

          // updating bonus status
           Bonuse::where('given_id', $auth_id)
           ->where('bonus_type', Bonuse::INCENTIVE)
           ->where('status', false)
           ->update(['status' => true]);
           DB::commit();
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getMessage()]);
        }
        return redirect()->back()->with(['success' => 'bonus added to your wallet.']);
    }
}
