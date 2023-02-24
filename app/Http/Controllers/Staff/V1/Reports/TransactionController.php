<?php

namespace App\Http\Controllers\Staff\V1\Reports;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
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
        $perPage = 10;

        if ($request->perPage) {
            $perPage = $request->perPage;
        }

        $query = Transaction::query()->with(['user', 'member']);

        if ($request->type && $request->type != "all") {
            $query->where('type', $request->type);
        }

        if ($request->form_date && $request->to_date) {
            $startDate = Carbon::createFromFormat('Y-m-d', $request->from_date)->startOfDay();
            $endDate = Carbon::createFromFormat('Y-m-d', $request->to_date)->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $charges = $query->orderByDesc('id')->paginate($perPage);

        return $this->withSuccess($charges);
    }
}
