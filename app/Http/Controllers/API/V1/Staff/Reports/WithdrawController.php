<?php

namespace App\Http\Controllers\API\V1\Staff\Reports;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use App\Traits\Formatter;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    use Formatter;

    public function withdrawList (Request $request) {

        $perPage = 10;
        if ($request->perPage) {
            $perPage = $request->perPage;
        }

        $query = Withdraw::query()->with('user:id,username');

        if ($request->form_date && $request->to_date) {
            $startDate = Carbon::createFromFormat('Y-m-d', $request->from_date)->startOfDay();
            $endDate = Carbon::createFromFormat('Y-m-d', $request->to_date)->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        if (in_array($request->status, [0,1,2])) {
            $query->where('status', '=', $request->status);
        }

        $withdraws = $query->orderByDesc('id')->paginate($perPage);

        return $this->withSuccess($withdraws);
    }
}
