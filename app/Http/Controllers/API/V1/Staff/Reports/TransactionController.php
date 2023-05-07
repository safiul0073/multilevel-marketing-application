<?php

namespace App\Http\Controllers\API\V1\Staff\Reports;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Services\ApiIndexQueryService;
use App\Traits\Formatter;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    use Formatter;
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $query = Transaction::query();

        if ($request->type && $request->type != "all") {
            $query->where('type', $request->type);
        }

        return ApiIndexQueryService::indexQuery(
            $query,
            ['user', 'member'],
            ['user.username'],
            !$request->isNotPaginate
        );
    }
}
