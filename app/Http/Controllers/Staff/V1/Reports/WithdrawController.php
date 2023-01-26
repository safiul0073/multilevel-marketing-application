<?php

namespace App\Http\Controllers\Staff\V1\Reports;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use App\Traits\Formatter;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    use Formatter;

    public function withdrawList (Request $request) {

        $status = $request->status ?? 0;

        $perPage = 10;
        if ($request->perPage) {
            $perPage = $request->perPage;
        }

        $withdraws = Withdraw::with('payment_method:id,name', 'user:id,username')->where('status', $status)
                            ->orderByDesc('id')->paginate($perPage);

        return $this->withSuccess($withdraws);
    }
}
