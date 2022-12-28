<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index () {

        return view('frontend.contents.dashboard.home');
    }
    public function userTeamView () {

        return view('frontend.contents.dashboard.my_team');
    }
    public function profile () {

        return view('frontend.contents.profile.index');
    }
    public function changePassView () {

        return view('frontend.contents.dashboard.change_password');
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
