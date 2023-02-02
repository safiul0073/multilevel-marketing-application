<?php

namespace App\Http\Controllers\Staff\V1\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Bonuse;
use App\Models\Purchase;
use App\Models\User;
use App\Models\Withdraw;
use App\Traits\Formatter;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    use Formatter;

    public function summationReport () {

        $total_member_income = Bonuse::sum('amount');
        $total_member = User::count();
        $total_package_purchase = Purchase::where('type', 1)->count();
        $total_withdraw = Withdraw::where('status', 1)->sum('amount');
        $data = [
            "total_member" => $total_member,
            "total_income" => $total_member_income,
            "total_package_purchase" => $total_package_purchase
        ];

        return $this->withSuccess($data);
    }
}
