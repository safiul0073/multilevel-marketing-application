<?php

namespace App\Http\Controllers\API\V1\Staff\Reports;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use App\Services\ApiIndexQueryService;
use App\Traits\Formatter;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    use Formatter;

    public function withdrawList (Request $request) {

        $query = Withdraw::query();

        if (in_array($request->status, [0,1,2])) {
            $query->where('status', '=', $request->status);
        }

        return ApiIndexQueryService::indexQuery(
            $query,
            ['user:id,username'],
            ['user.username'],
        );
    }

    public function withdrawListExcel (Request $request) {

        $query = Withdraw::query();


        if (in_array($request->status, [0,1,2])) {
            $query->where('status', '=', $request->status);
        }

        return ApiIndexQueryService::indexQuery(
            $query,
            ['user:id,username'],
            ['user.username'],
            false
        );
    }
}
