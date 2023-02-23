<?php

namespace App\Http\Controllers\Staff\V1\Reports;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Traits\Formatter;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    use Formatter;

    public function packagePurchaseList (Request $request) {

        $perPage = 10;

        if ($request->perPage) {
            $perPage = $request->perPage;
        }

        $purchases = Purchase::with(['user:id,first_name,last_name,username', 'product' => fn ($q) => $q->with('category:id,title')])
                                ->when($request->from_date && $request->to_date, function ($q) use ($request) {
                                    $startDate = Carbon::createFromFormat('Y-m-d', $request->from_date)->startOfDay();
                                    $endDate = Carbon::createFromFormat('Y-m-d', $request->to_date)->endOfDay();
                                    $q->whereBetween('created_at', [$startDate, $endDate]);
                                })
                                ->where('type', $request->type)
                                ->latest('id')
                                ->paginate($perPage);

        return $this->withSuccess($purchases);
    }
}
