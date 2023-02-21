<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index () {
        $user = User::with('sponsor','nominee')
                    ->withSum('purchases as purchase_amount', 'amount')
                    ->withSum(['bonuses as total_bonus'
                        => fn ($query) => $query->where('bonus_type', 'incentive') ],'amount')
                    ->withSum(['bonuses as matching_bonus'
                        => fn ($query) => $query->where('bonus_type', 'matching') ],'amount')
                    ->withSum(['bonuses as referral_bonus'
                        => fn ($query) => $query->where('bonus_type', 'joining') ],'amount')
                    ->withSum(['bonuses as gen_bonus'
                        => fn ($query) => $query->where('bonus_type', 'gen') ],'amount')
                    ->withSum(['withdraws as withdraw_amount'
                        => fn ($query) => $query->where('status', 1) ], 'amount')
                    ->withSum(['transactions as death_amount'
                        => fn ($query) => $query->where('type', Transaction::DEATH) ], 'amount')
                    ->withSum(['transactions as education_amount'
                        => fn ($query) => $query->where('type', Transaction::EDUCATION) ], 'amount')
                    ->with(['image', 'rewards' => fn ($q) => $q->orderBy('left_count', 'desc')->limit(1)])
                    ->where('id', auth()->id())->first();
        return view('frontend.contents.dashboard.home', ['user' => $user]);
    }


    public function productPurchaseView () {
        $purchases = Purchase::where('user_id', auth()->id())->where('status', 1)->latest('id')->paginate(10);
        return view('frontend.contents.dashboard.product_purchase', ["purchases" => $purchases]);
    }

    public function depositView () {

        return view('frontend.contents.dashboard.deposit');
    }

    public function balanceTransferView () {
        $transactions = Transaction::with('member')->where('user_id', auth()->id())->latest('id')->paginate(10);
        return view('frontend.contents.dashboard.balance_transfer', ['transactions' => $transactions]);
    }

    public function invoiceView () {

        return view('frontend.contents.dashboard.invoice');
    }
}
