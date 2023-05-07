<?php

namespace App\Http\Controllers\API\V1\Staff\Reports;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Services\ApiIndexQueryService;
use App\Traits\Formatter;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    use Formatter;

    public function packagePurchaseList (Request $request) {

        $query = Purchase::query()->where('type', $request->type);

        return ApiIndexQueryService::indexQuery(
            $query,
            ['user:id,first_name,last_name,username', 'product' => fn ($q) => $q->with('category:id,title')],
            ['bonus_got.username'],
            true
        );
    }

    public function packagePurchaseExcelList (Request $request) {

        $query = Purchase::query()->where('type', $request->type);

        return ApiIndexQueryService::indexQuery(
            $query,
            ['user:id,first_name,last_name,username', 'product' => fn ($q) => $q->with('category:id,title')],
            ['bonus_got.username'],
            false
        );
    }
}
