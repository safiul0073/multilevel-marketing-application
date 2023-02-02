<?php

namespace App\Http\Controllers\Staff\V1\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Bonuse;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function summationReport () {

        $total_member_income = Bonuse::sum('amount');
        $total_member = User::count();
        $total_package_purchase = Purchase::where('is_package', 1)->count();

    }
}
