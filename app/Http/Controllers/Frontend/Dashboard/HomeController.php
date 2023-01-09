<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index () {
        $user = User::with('sponsor','nominee')
                    ->withSum('purchases as purchase_amount', 'amount')
                    ->withSum(['bonuses as total_bonus'
                        => fn ($query) => $query->whereDate('created_at', today()) ],'amount')
                    ->withSum(['bonuses as matching_bonus'
                        => fn ($query) => $query->where('bonus_type', 'matching') ],'amount')
                    ->withSum(['bonuses as referral_bonus'
                        => fn ($query) => $query->where('bonus_type', 'joining') ],'amount')
                    ->withSum(['transactions as withdraw_amount'
                        => fn ($query) => $query->where('type', 'withdraw') ], 'amount')
                        ->withSum(['transactions as deposit_amount'
                        => fn ($query) => $query->where('type', 'deposit') ], 'amount')
                    ->with('image')
                    ->where('id', auth()->id())->first();
        return view('frontend.contents.dashboard.home', ['user' => $user]);
    }


    public function productPurchaseView () {

        return view('frontend.contents.dashboard.product_purchase');
    }

    public function depositView () {

        return view('frontend.contents.dashboard.deposit');
    }

    public function balanceTransferView () {

        return view('frontend.contents.dashboard.balance_transfer');
    }

    public function invoiceView () {

        return view('frontend.contents.dashboard.invoice');
    }
}
