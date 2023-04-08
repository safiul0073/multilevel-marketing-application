<?php

namespace App\Http\Controllers\API\V1\Staff\Reports;

use App\Http\Controllers\Controller;
use App\Models\Charge;
use App\Services\ApiIndexQueryService;
use App\Traits\Formatter;
use Illuminate\Http\Request;

class ChargeController extends Controller
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
        return ApiIndexQueryService::indexQuery(
            Charge::query(),
            ['holder'],
            ['holder.user.username']
        );
    }
}
