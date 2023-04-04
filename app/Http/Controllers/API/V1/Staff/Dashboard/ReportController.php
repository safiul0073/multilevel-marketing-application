<?php

namespace App\Http\Controllers\API\V1\Staff\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\User;
use App\Models\Withdraw;
use App\Traits\Formatter;

class ReportController extends Controller
{

    use Formatter;

    public function summationReport () {

        $total_member_income = User::sum('balance');
        $total_member = User::count();
        $total_package_purchase = Purchase::where('type', 1)->count();
        $total_withdraw_success = Withdraw::where('status', 1)->count();
        $total_withdraw_pending = Withdraw::where('status', 0)->count();
        $total_weekly_user = User::whereBetween('created_at', getDateArray(6))->count();
        $total_monthly_user = User::whereMonth('created_at', date('m'))->count();
        $total_yearly_user = User::whereYear('created_at', date('Y'))->count();
        $data = [
            "total_member" => $total_member,
            "total_income" => $total_member_income,
            "total_package_purchase" => $total_package_purchase,
            'total_withdraw_success' => $total_withdraw_success,
            'total_withdraw_pending' => $total_withdraw_pending,
            'total_weekly_user' => $total_weekly_user,
            'total_monthly_user' => $total_monthly_user,
            'total_yearly_user' => $total_yearly_user,
        ];

        return $this->withSuccess($data);
    }

    public function userCountByDate () {


    }
}
